<?php

namespace JuLongDevice\Common;

use JuLongDevice\Common\Exception\DeviceSDKException;
use JuLongDevice\Common\Http\HttpConnection;
use JuLongDevice\Common\Profile\ClientProfile;
use JuLongDevice\Common\Profile\HttpProfile;
use JuLongDevice\Exception\ActionParameterException;
use JuLongDevice\Exception\AddTimeoutException;
use JuLongDevice\Exception\AlgorithmManufacturerException;
use JuLongDevice\Exception\AlgorithmTypeException;
use JuLongDevice\Exception\AlgorithmVersionException;
use JuLongDevice\Exception\BufferOutOfRangeException;
use JuLongDevice\Exception\ChipManufacturerException;
use JuLongDevice\Exception\ChipTypeException;
use JuLongDevice\Exception\CreationHandleException;
use JuLongDevice\Exception\DatabaseFileCorruptionException;
use JuLongDevice\Exception\DatabaseNotExistException;
use JuLongDevice\Exception\DatabaseOperationException;
use JuLongDevice\Exception\DataParameterException;
use JuLongDevice\Exception\DateFieldErrorException;
use JuLongDevice\Exception\DeleteObjectException;
use JuLongDevice\Exception\DeviceAllocateMemoryException;
use JuLongDevice\Exception\DeviceBusyException;
use JuLongDevice\Exception\DeviceHandleTimeoutException;
use JuLongDevice\Exception\DeviceOfflineException;
use JuLongDevice\Exception\DeviceRegisterException;
use JuLongDevice\Exception\DeviceTypeException;
use JuLongDevice\Exception\DownloadFileException;
use JuLongDevice\Exception\ExtractFeatureValueException;
use JuLongDevice\Exception\FaceAreaException;
use JuLongDevice\Exception\FaceDetectionException;
use JuLongDevice\Exception\FaceListEmptyException;
use JuLongDevice\Exception\FeatureValueDataLengthException;
use JuLongDevice\Exception\FileNameNumberDuplicateException;
use JuLongDevice\Exception\FileOpenException;
use JuLongDevice\Exception\FileSizeException;
use JuLongDevice\Exception\FullLibException;
use JuLongDevice\Exception\GetPhotoParameterException;
use JuLongDevice\Exception\ImageReadException;
use JuLongDevice\Exception\ImageSizeException;
use JuLongDevice\Exception\JsonParseException;
use JuLongDevice\Exception\NameParameterException;
use JuLongDevice\Exception\NoDataException;
use JuLongDevice\Exception\OtherParameterException;
use JuLongDevice\Exception\OutOfStorageException;
use JuLongDevice\Exception\ParameterException;
use JuLongDevice\Exception\PathParameterInvalidException;
use JuLongDevice\Exception\PersonIdParameterException;
use JuLongDevice\Exception\PersonInfoParameterException;
use JuLongDevice\Exception\PersonNameParameterException;
use JuLongDevice\Exception\PersonNotExistException;
use JuLongDevice\Exception\PersonPhotoParameterException;
use JuLongDevice\Exception\PersonTypeParameterException;
use JuLongDevice\Exception\PictureFormatException;
use JuLongDevice\Exception\PlanFieldErrorException;
use JuLongDevice\Exception\PoorQualityImageException;
use JuLongDevice\Exception\RepeatCheckInException;
use JuLongDevice\Exception\SessionParameterException;
use JuLongDevice\Exception\SignParameterException;
use JuLongDevice\Exception\TemporaryFaceListValidTimeException;
use JuLongDevice\Exception\ThresholdOutOfRangeException;
use JuLongDevice\Exception\TimeStampParameterException;
use JuLongDevice\Exception\UploadFileException;
use ReflectionClass;

/**
 * 抽象api类，禁止client引用
 * Created on 2021/12/23 10:00
 * Create by LZH
 */
abstract class AbstractClient
{
    /**
     * @var string SDK版本
     */
    public static $SDK_VERSION = "SDK_PHP_1.0.0";

    /**
     * @var integer http响应码200
     */
    public static $HTTP_RSP_OK = 200;

    private $PHP_VERSION_MINIMUM = "5.6.0";

    /**
     * @var ClientProfile 会话配置信息类
     */
    private $profile;

    /**
     * @var string 请求路径
     */
    private $path;

    /**
     * @var HttpConnection
     */
    private $httpConn;

    /**
     * 基础client类
     * @param ClientProfile $profile
     */
    function __construct($profile=null)
    {
        $this->path = "/Request";
        if ($profile) {
            $this->profile = $profile;
        } else {
            $this->profile = new ClientProfile();
        }

        $this->getRefreshedEndpoint();

        if (version_compare(phpversion(), $this->PHP_VERSION_MINIMUM, '<') && $profile->getCheckPHPVersion()) {
            throw new DeviceSDKException("ClientError", "PHP version must >= ".$this->PHP_VERSION_MINIMUM.", your current is ".phpversion());
        }

        $this->httpConn = $this->createConnect();
    }

    /**
     * 设置配置实例
     * @param ClientProfile $profile 配置实例
     */
    public function setClientProfile($profile)
    {
        $this->profile = $profile;
    }

    /**
     * 返回配置实例
     * @return ClientProfile
     */
    public function getClientProfile()
    {
        return $this->profile;
    }

    /**
     * @param string $action  方法名
     * @param array $request  参数列表
     * @return mixed
     */
    public function __call($action, $request)
    {
        return $this->doRequestWithOptions($action, $request[0], array());
    }

    /**
     * 发出带参数的请求
     * @param $action
     * @param $request
     * @param $options
     * @return mixed
     * @throws DeviceSDKException
     * @author LZH
     * @since 2021/12/23
     */
    protected function doRequestWithOptions($action, $request, $options)
    {
        try {
            $responseData = null;
            /* @var AbstractModel $request */
            $serializeRequest = $request->serialize(); // 请求对象序列化
//            $method = $this->getPrivateMethod($request, "arrayMerge");
//            $serializeRequest = $method->invoke($request, $serializeRequest);
            switch ($this->profile->getSignMethod()) {
                case ClientProfile::$SIGN_HMAC_SHA1:
                case ClientProfile::$SIGN_HMAC_SHA256:
                    $responseData = $this->doRequest($action, $serializeRequest);
                    break;
                default: // 如果没有设置签名方法，则不签名；未知的签名方法默认都是md5签名
                    $responseData = $this->doRequestWithMd5($action, $serializeRequest);
                    break;
            }

            if ($responseData->getStatusCode() !== AbstractClient::$HTTP_RSP_OK) {
                throw new DeviceSDKException($responseData->getReasonPhrase(), $responseData->getBody());
            }
            $tmpResp = json_decode($responseData->getBody(), true);
            print_r($tmpResp);
            if (array_key_exists("Code", $tmpResp) && $tmpResp['Code'] == 0) {
                throw $this->errorCodeConvertToException($tmpResp);
            } else if (array_key_exists('ErrorCode', $tmpResp) && $tmpResp['ErrorCode'] == 0) {
                // JVTPlatformReq 请求响应的处理
                throw new DeviceSDKException($tmpResp["ErrorCode"], $tmpResp["Result"], $tmpResp["Name"]);
            }
            return $this->returnResponse($action, $tmpResp); // 初始化响应对象
        } catch (\Exception $e) {
            if (!($e instanceof DeviceSDKException)) {
                throw new DeviceSDKException("", $e->getMessage());
            } else {
                throw $e;
            }
        }
    }

    /**
     * 错误转换为对应的异常类
     * @param $res array 响应
     * @throws DeviceRegisterException|DeviceSDKException
     * @since 2022/01/04
     * @author LZH
     */
    private function errorCodeConvertToException($res)
    {
        $exception = null;
        $code = $res['Code'];
        $message = $res['Message'];
        $name = $res['Name'];
        switch ($code) {
            case '1001':
                $exception = new DeviceRegisterException($code, $message, $name);
                break;
            case '1002':
                $exception = new JsonParseException($code, $message, $name);
                break;
            case '1003':
                $exception = new SessionParameterException($code, $message, $name);
                break;
            case '1004':
                $exception = new TimeStampParameterException($code, $message, $name);
                break;
            case '1005':
                $exception = new SignParameterException($code, $message, $name);
                break;
            case '1006':
                $exception = new NameParameterException($code, $message, $name);
                break;
            case '1101':
                $exception = new DataParameterException($code, $message, $name);
                break;
            case '1102':
                $exception = new ActionParameterException($code, $message, $name);
                break;
            case '1103':
                $exception = new PersonTypeParameterException($code, $message, $name);
                break;
            case '1104':
                $exception = new PersonIdParameterException($code, $message, $name);
                break;
            case '1105':
                $exception = new GetPhotoParameterException($code, $message, $name);
                break;
            case '1106':
                $exception = new PersonNotExistException($code, $message, $name);
                break;
            case '1107':
                $exception = new PersonInfoParameterException($code, $message, $name);
                break;
            case '1108':
                $exception = new PersonNameParameterException($code, $message, $name);
                break;
            case '1109':
                $exception = new PersonPhotoParameterException($code, $message, $name);
                break;
            case '1110':
                $exception = $this->resultCodeConvertToException($res);
                break;
            case '1111':
                $exception = new OtherParameterException($code, $message, $name);
                break;
            case '1112':
                $exception = new DeviceOfflineException($code, $message, $name);
                break;
            case '1113':
                $exception = new DeviceHandleTimeoutException($code, $message, $name);
                break;
            case '1114':
                $exception = new DeviceAllocateMemoryException($code, $message, $name);
                break;
            case '1115':
                $exception = new PathParameterInvalidException($code, $message, $name);
                break;
            case '1116':
                $exception = new DownloadFileException($code, $message, $name);
                break;
            case '1117':
                break;
            case '1118':
                $exception = new UploadFileException($code, $message, $name);
                break;
            default:
                $exception = new DeviceSDKException($code, $message, $name);
        }
        return $exception;
    }

    private function resultCodeConvertToException($res) {
        $excption = null;

        if (!$res['Data']) {
            throw new DeviceSDKException("", "响应的Data字段为空", $res['Name']);
        }

        $result = $res['Data']['Result'];
        $action = $res['Data']['Action'] ?? $res['Name'];
        switch ($result) {
            case '-1':
                $message = "异常";
                $exception = new DeviceSDKException($result, $message, $action);
                break;
            case '-2':
                $message = "提取特征值失败";
                $exception = new ExtractFeatureValueException($result, $message, $action);
                break;
            case '-3':
                $message = "文件名字编号重复";
                $exception = new FileNameNumberDuplicateException($result, $message, $action);
                break;
            case '-4':
                $message = "名单库满";
                $exception = new FullLibException($result, $message, $action);
                break;
            case '-5':
                $message = "添加超时";
                $exception = new AddTimeoutException($result, $message, $action);
                break;
            case '-6':
                $message = "参数错误";
                $exception = new ParameterException($result, $message, $action);
                break;
            case '-7':
                $message = "文件太大";
                $exception = new FileSizeException($result, $message, $action);
                break;
            case '-8':
                $message = "存储空间不足";
                $exception = new OutOfStorageException($result, $message, $action);
                break;
            case '-9':
                $message = "文件打开失败";
                $exception = new FileOpenException($result, $message, $action);
                break;
            case '-10':
                $message = "没有数据库";
                $exception = new DatabaseNotExistException($result, $message, $action);
                break;
            case '-11':
                $message = "图片读取失败";
                $exception = new ImageReadException($result, $message, $action);
                break;
            case '-12':
                $message = "数据库文件损坏";
                $exception = new DatabaseFileCorruptionException($result, $message, $action);
                break;
            case '-13':
                $message = "图片质量差";
                $exception = new PoorQualityImageException($result, $message, $action);
                break;
            case '-14':
                $message = "图片尺寸错误，宽高不能为奇数";
                $exception = new ImageSizeException($result, $message, $action);
                break;
            case '-15':
                $message = "检测人脸失败（没检测到人脸或者检测到多人脸）";
                $exception = new FaceDetectionException($result, $message, $action);
                break;
            case '-16':
                $message = "图片格式错误";
                $exception = new PictureFormatException($result, $message, $action);
                break;
            case '-17':
                $message = "人脸区域错误";
                $exception = new FaceAreaException($result, $message, $action);
                break;
            case '-18':
                $message = "算法创建句柄错误";
                $exception = new CreationHandleException($result, $message, $action);
                break;
            case '-19':
                $message = "设备忙";
                $exception = new DeviceBusyException($result, $message, $action);
                break;
            case '-20':
                $message = "文件写入失败";
                $exception = new DeviceBusyException($result, $message, $action);
                break;
            case '-21':
                $message = "删除失败(未找到对应的ID删除)";
                $exception = new DeleteObjectException($result, $message, $action);
                break;
            case '-22':
                $message = "分配内存失败";
                $exception = new DeviceAllocateMemoryException($result, $message, $action);
                break;
            case '-23':
                $message = "名单库人数为空";
                $exception = new FaceListEmptyException($result, $message, $action);
                break;
            case '-24':
                $message = "临时名单有效时间错误";
                $exception = new TemporaryFaceListValidTimeException($result, $message, $action);
                break;
            case '-51':
                $message = "数据异常";
                $exception = new DeviceSDKException($result, $message, $action); // TODO 该异常不清楚
                break;
            case '-52':
                $message = "数据标志错误";
                $exception = new DeviceSDKException($result, $message, $action); // TODO 该异常不清楚
                break;
            case '-53':
                $message = "数据长度错误";
                $exception = new DeviceSDKException($result, $message, $action); // TODO 该异常不清楚
                break;
            case '-54':
                $message = "特征值数据长度错误";
                $exception = new FeatureValueDataLengthException($result, $message, $action);
                break;
            case '-55':
                $message = "芯片厂商错误";
                $exception = new ChipManufacturerException($result, $message, $action);
                break;
            case '-56':
                $message = "芯片类型错误";
                $exception = new ChipTypeException($result, $message, $action);
                break;
            case '-57':
                $message = "算法厂商错误";
                $exception = new AlgorithmManufacturerException($result, $message, $action);
                break;
            case '-58':
                $message = "算法类型错误";
                $exception = new AlgorithmTypeException($result, $message, $action);
                break;
            case '-59':
                $message = "设备类型错误";
                $exception = new DeviceTypeException($result, $message, $action);
                break;
            case '-60':
                $message = "算法版本错误";
                $exception = new AlgorithmVersionException($result, $message, $action);
                break;
            case '-61':
                $message = "数据库操作失败";
                $exception = new DatabaseOperationException($result, $message, $action);
                break;
            case '-62':
                $message = "查无此人";
                $exception = new FaceDetectionException($result, $message, $action);
                break;
            case '-5102':
                $message = "Plan字段不正确";
                $exception = new PlanFieldErrorException($result, $message, $action);
                break;
            case '-5103':
                $message = "Date字段不正确";
                $exception = new DateFieldErrorException($result, $message, $action);
                break;
            case '-5104':
                $message = "重复签到";
                $exception = new RepeatCheckInException($result, $message, $action);
                break;
            case '-5105':
                $message = "无数据（未发生预案）";
                $exception = new NoDataException($result, $message, $action);
                break;
            case '-5106':
                $message = "阈值超出范围";
                $exception = new ThresholdOutOfRangeException($result, $message, $action);
                break;
            case '-5107':
                $message = "缓冲超出范围";
                $exception = new BufferOutOfRangeException($result, $message, $action);
                break;
            default:
                $message = "异常";
                $exception = new DeviceSDKException($result, $message, $action);
        }

        return $exception;
    }

    private function doRequest($action, $request)
    {
        switch ($this->profile->getHttpProfile()->getReqMethod()) {
            case HttpProfile::$REQ_GET:
                return $this->getRequest($action, $request);
                break;
            case HttpProfile::$REQ_POST:
                return $this->postRequest($action, $request);
                break;
            default:
                throw new DeviceSDKException("", "Method only support (GET, POST)");
                break;
        }
    }

    private function doRequestWithMd5($action, $request)
    {
        switch ($this->profile->getHttpProfile()->getReqMethod()) {
            case HttpProfile::$REQ_GET:
                return $this->getRequestWithMd5($action, $request);
                break;
            case HttpProfile::$REQ_POST:
                return $this->postRequestWithMd5($action, $request);
                break;
            default:
                throw new DeviceSDKException("", "Method only support (GET, POST)");
                break;
        }
    }

    private function getMultipartPayload($request, $boundary, $options)
    {
        $body = "";
        $params = $request->serialize();
        foreach ($params as $key => $value) {
            $body .= "--".$boundary."\r\n";
            $body .= "Content-Disposition: form-data; name=\"".$key;
            if (in_array($key, $options["BinaryParams"])) {
                $body .= "\"; filename=\"".$key;
            }
            $body .= "\"\r\n";
            if (is_array($value)) {
                $value = json_encode($value);
                $body .= "Content-Type: application/json\r\n";
            }
            $body .= "\r\n".$value."\r\n";
        }
        if ($body != "") {
            $body .= "--".$boundary."--\r\n";
        }
        return $body;
    }

    private function getRequestWithMd5($action, $request)
    {
        $query = $this->formatRequestDataWithMd5($action, $request);
        $connect = $this->getConnect();
        return $connect->getRequest($this->path, $query, []);
    }

    private function postRequestWithMd5($action, $request)
    {
        $body = $this->formatRequestDataWithMd5($action, $request);
        $connect = $this->getConnect();
        $header = [
            "Content-Type" => "application/json"
        ];
        return $connect->postRequestRaw($this->path, $header, $body);
    }

    private function getRequest($action, $request)
    {
        $query = $this->formatRequestData($action, $request, httpProfile::$REQ_GET);
        $connect = $this->getConnect();
        return $connect->getRequest($this->path, $query, []);
    }

    private function postRequest($action, $request)
    {
        $body = $this->formatRequestData($action, $request, httpProfile::$REQ_POST);
        $connect = $this->getConnect();
        $header = [
            "Content-Type" => "application/json",
        ];
        return $connect->postRequestRaw($this->path, $header, $body);
    }

    /**
     * 格式化请求数据
     * @param $action
     * @param $request
     * @param $reqMethod
     * @return mixed
     * @throws DeviceSDKException
     * @author LZH
     * @since 2021/12/23
     */
    private function formatRequestDataWithMd5($action, $request)
    {
        $param = $request;
        $param['Name'] = $request["Name"] ?? $action;
        $param['Name'] = $this->formatName($param['Name']);
        $clientProfile = $this->getClientProfile();
        if($clientProfile->getSignMethod()) {

            $param['Timestamp'] = $request['Timestamp'] ?? time(); // 如果请求中已经设置，则使用请求中的，否则初始化
            $param['UUID'] = $clientProfile->getUUID();

            if ($clientProfile->getDeviceAdmin()) {
                $username = $clientProfile->getDeviceAdmin();
            }

            if ($clientProfile->getDevicePassword()) {
                $password = $clientProfile->getDevicePassword();
            }

            $signStr = $this->formatSignString($param['UUID'], $username, $password, $param["Timestamp"]);
            $param["Sign"] = Sign::signMd5($signStr);
        }
        return $param;
    }

    private function formatName($action) {
        switch ($action) {
            case 'JVTPlatform':
                return $action . 'Req';
                break;
            default:
                return $action . 'Request';
        }
    }

    // 创建新的连接
    private function createConnect()
    {
        $prot = $this->profile->getHttpProfile()->getProtocol();
        return new HttpConnection($prot.$this->getRefreshedEndpoint(), $this->profile);
    }

    // 获取连接，根据是否保持连接，或者新建或者返回原先的连接
    private function getConnect() {
        $keepAlive = $this->profile->getHttpProfile()->getKeepAlive();
        if (true === $keepAlive) {
            return $this->httpConn;
        } else {
            return $this->createConnect();
        }
    }

    /**
     * 格式化签名字符串
     * @param $UUID
     * @param $userName
     * @param $passWord
     * @param $timestamp
     * @return string
     * @author LZH
     * @since 2021/12/23
     */
    private function formatSignString($UUID, $userName, $passWord, $timestamp)
    {
        return $UUID . ":" . $userName . ":" . $passWord . ":" . $timestamp;
    }

    /**
     * 通过反射获取对象指定的方法，包括公开、私有的方法
     * @param $obj
     * @param $methodName
     * @return \ReflectionMethod
     * @throws \ReflectionException
     * @author LZH
     * @since 2021/12/23
     */
    private function getPrivateMethod($obj, $methodName) {
        $objReflectClass = new ReflectionClass(get_class($obj));
        $method = $objReflectClass->getMethod($methodName);
        $method->setAccessible(true);
        return $method;
    }

    /**
     * 获取请求URL
     * @return string
     * @author LZH
     * @since 2021/12/23
     */
    private function getRefreshedEndpoint() {
        $this->endpoint = $this->profile->getHttpProfile()->getEndpoint();
        if ($this->endpoint === null) {
            $this->endpoint = $this->service.".".$this->profile->getHttpProfile()->getRootDomain();
        }
        return $this->endpoint;
    }

}