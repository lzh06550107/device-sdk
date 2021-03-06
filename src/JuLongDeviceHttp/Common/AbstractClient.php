<?php

declare(strict_types=1);

namespace JuLongDeviceHttp\Common;

use JuLongDeviceHttp\Common\Exception\DeviceSDKException;
use JuLongDeviceHttp\Common\Http\HttpConnection;
use JuLongDeviceHttp\Common\Profile\ClientProfile;
use JuLongDeviceHttp\Common\Profile\HttpProfile;
use JuLongDeviceHttp\Exception\ActionParameterException;
use JuLongDeviceHttp\Exception\AddTimeoutException;
use JuLongDeviceHttp\Exception\AlgorithmManufacturerException;
use JuLongDeviceHttp\Exception\AlgorithmTypeException;
use JuLongDeviceHttp\Exception\AlgorithmVersionException;
use JuLongDeviceHttp\Exception\BufferOutOfRangeException;
use JuLongDeviceHttp\Exception\ChipManufacturerException;
use JuLongDeviceHttp\Exception\ChipTypeException;
use JuLongDeviceHttp\Exception\CreationHandleException;
use JuLongDeviceHttp\Exception\DatabaseFileCorruptionException;
use JuLongDeviceHttp\Exception\DatabaseNotExistException;
use JuLongDeviceHttp\Exception\DatabaseOperationException;
use JuLongDeviceHttp\Exception\DataParameterException;
use JuLongDeviceHttp\Exception\DateFieldErrorException;
use JuLongDeviceHttp\Exception\DeleteObjectException;
use JuLongDeviceHttp\Exception\DeviceAllocateMemoryException;
use JuLongDeviceHttp\Exception\DeviceBusyException;
use JuLongDeviceHttp\Exception\DeviceHandleTimeoutException;
use JuLongDeviceHttp\Exception\DeviceOfflineException;
use JuLongDeviceHttp\Exception\DeviceRegisterException;
use JuLongDeviceHttp\Exception\DeviceTypeException;
use JuLongDeviceHttp\Exception\DownloadFileException;
use JuLongDeviceHttp\Exception\ExtractFeatureValueException;
use JuLongDeviceHttp\Exception\FaceAreaException;
use JuLongDeviceHttp\Exception\FaceDetectionException;
use JuLongDeviceHttp\Exception\FaceListEmptyException;
use JuLongDeviceHttp\Exception\FeatureValueDataLengthException;
use JuLongDeviceHttp\Exception\FileNameNumberDuplicateException;
use JuLongDeviceHttp\Exception\FileOpenException;
use JuLongDeviceHttp\Exception\FileSizeException;
use JuLongDeviceHttp\Exception\FullLibException;
use JuLongDeviceHttp\Exception\GetPhotoParameterException;
use JuLongDeviceHttp\Exception\ImageReadException;
use JuLongDeviceHttp\Exception\ImageSizeException;
use JuLongDeviceHttp\Exception\JsonParseException;
use JuLongDeviceHttp\Exception\NameParameterException;
use JuLongDeviceHttp\Exception\NoDataException;
use JuLongDeviceHttp\Exception\OtherParameterException;
use JuLongDeviceHttp\Exception\OutOfStorageException;
use JuLongDeviceHttp\Exception\ParameterException;
use JuLongDeviceHttp\Exception\PathParameterInvalidException;
use JuLongDeviceHttp\Exception\PersonIdParameterException;
use JuLongDeviceHttp\Exception\PersonInfoParameterException;
use JuLongDeviceHttp\Exception\PersonNameParameterException;
use JuLongDeviceHttp\Exception\PersonNotExistException;
use JuLongDeviceHttp\Exception\PersonPhotoParameterException;
use JuLongDeviceHttp\Exception\PersonTypeParameterException;
use JuLongDeviceHttp\Exception\PictureFormatException;
use JuLongDeviceHttp\Exception\PlanFieldErrorException;
use JuLongDeviceHttp\Exception\PoorQualityImageException;
use JuLongDeviceHttp\Exception\RepeatCheckInException;
use JuLongDeviceHttp\Exception\SessionParameterException;
use JuLongDeviceHttp\Exception\SignParameterException;
use JuLongDeviceHttp\Exception\TemporaryFaceListValidTimeException;
use JuLongDeviceHttp\Exception\ThresholdOutOfRangeException;
use JuLongDeviceHttp\Exception\TimeStampParameterException;
use JuLongDeviceHttp\Exception\UploadFileException;
use ReflectionClass;

/**
 * ??????api????????????client??????
 * Created on 2021/12/23 10:00
 * Create by LZH
 */
abstract class AbstractClient
{
    /**
     * @var string SDK??????
     */
    public static $SDK_VERSION = "SDK_PHP_1.0.0";

    /**
     * @var integer http?????????200
     */
    public static $HTTP_RSP_OK = 200;

    private $PHP_VERSION_MINIMUM = "5.6.0";

    /**
     * @var ClientProfile ?????????????????????
     */
    private $profile;

    /**
     * @var string ????????????
     */
    private $path;

    /**
     * @var HttpConnection
     */
    private $httpConn;

    /**
     * ??????client???
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
     * ??????????????????
     * @param ClientProfile $profile ????????????
     */
    public function setClientProfile($profile)
    {
        $this->profile = $profile;
    }

    /**
     * ??????????????????
     * @return ClientProfile
     */
    public function getClientProfile()
    {
        return $this->profile;
    }

    /**
     * @param string $action  ?????????
     * @param array $request  ????????????
     * @return mixed
     */
    public function __call($action, $request)
    {
        return $this->doRequestWithOptions($action, $request[0], array());
    }

    /**
     * ????????????????????????
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
            $serializeRequest = $request->serialize(); // ?????????????????????
//            $method = $this->getPrivateMethod($request, "arrayMerge");
//            $serializeRequest = $method->invoke($request, $serializeRequest);
            switch ($this->profile->getSignMethod()) {
                case ClientProfile::$SIGN_HMAC_SHA1:
                case ClientProfile::$SIGN_HMAC_SHA256:
                    $responseData = $this->doRequest($action, $serializeRequest);
                    break;
                default: // ?????????????????????????????????????????????????????????????????????????????????md5??????
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
                // JVTPlatformReq ?????????????????????
                throw new DeviceSDKException($tmpResp["ErrorCode"], $tmpResp["Result"], $tmpResp["Name"]);
            }
            return $this->returnResponse($action, $tmpResp); // ?????????????????????
        } catch (\Exception $e) {
            if (!($e instanceof DeviceSDKException)) {
                throw new DeviceSDKException("", $e->getMessage());
            } else {
                throw $e;
            }
        }
    }

    /**
     * ?????????????????????????????????
     * @param $res array ??????
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
            throw new DeviceSDKException("", "?????????Data????????????", $res['Name']);
        }

        $result = $res['Data']['Result'];
        $action = $res['Data']['Action'] ?? $res['Name'];
        switch ($result) {
            case '-1':
                $message = "??????";
                $exception = new DeviceSDKException($result, $message, $action);
                break;
            case '-2':
                $message = "?????????????????????";
                $exception = new ExtractFeatureValueException($result, $message, $action);
                break;
            case '-3':
                $message = "????????????????????????";
                $exception = new FileNameNumberDuplicateException($result, $message, $action);
                break;
            case '-4':
                $message = "????????????";
                $exception = new FullLibException($result, $message, $action);
                break;
            case '-5':
                $message = "????????????";
                $exception = new AddTimeoutException($result, $message, $action);
                break;
            case '-6':
                $message = "????????????";
                $exception = new ParameterException($result, $message, $action);
                break;
            case '-7':
                $message = "????????????";
                $exception = new FileSizeException($result, $message, $action);
                break;
            case '-8':
                $message = "??????????????????";
                $exception = new OutOfStorageException($result, $message, $action);
                break;
            case '-9':
                $message = "??????????????????";
                $exception = new FileOpenException($result, $message, $action);
                break;
            case '-10':
                $message = "???????????????";
                $exception = new DatabaseNotExistException($result, $message, $action);
                break;
            case '-11':
                $message = "??????????????????";
                $exception = new ImageReadException($result, $message, $action);
                break;
            case '-12':
                $message = "?????????????????????";
                $exception = new DatabaseFileCorruptionException($result, $message, $action);
                break;
            case '-13':
                $message = "???????????????";
                $exception = new PoorQualityImageException($result, $message, $action);
                break;
            case '-14':
                $message = "??????????????????????????????????????????";
                $exception = new ImageSizeException($result, $message, $action);
                break;
            case '-15':
                $message = "??????????????????????????????????????????????????????????????????";
                $exception = new FaceDetectionException($result, $message, $action);
                break;
            case '-16':
                $message = "??????????????????";
                $exception = new PictureFormatException($result, $message, $action);
                break;
            case '-17':
                $message = "??????????????????";
                $exception = new FaceAreaException($result, $message, $action);
                break;
            case '-18':
                $message = "????????????????????????";
                $exception = new CreationHandleException($result, $message, $action);
                break;
            case '-19':
                $message = "?????????";
                $exception = new DeviceBusyException($result, $message, $action);
                break;
            case '-20':
                $message = "??????????????????";
                $exception = new DeviceBusyException($result, $message, $action);
                break;
            case '-21':
                $message = "????????????(??????????????????ID??????)";
                $exception = new DeleteObjectException($result, $message, $action);
                break;
            case '-22':
                $message = "??????????????????";
                $exception = new DeviceAllocateMemoryException($result, $message, $action);
                break;
            case '-23':
                $message = "?????????????????????";
                $exception = new FaceListEmptyException($result, $message, $action);
                break;
            case '-24':
                $message = "??????????????????????????????";
                $exception = new TemporaryFaceListValidTimeException($result, $message, $action);
                break;
            case '-51':
                $message = "????????????";
                $exception = new DeviceSDKException($result, $message, $action); // TODO ??????????????????
                break;
            case '-52':
                $message = "??????????????????";
                $exception = new DeviceSDKException($result, $message, $action); // TODO ??????????????????
                break;
            case '-53':
                $message = "??????????????????";
                $exception = new DeviceSDKException($result, $message, $action); // TODO ??????????????????
                break;
            case '-54':
                $message = "???????????????????????????";
                $exception = new FeatureValueDataLengthException($result, $message, $action);
                break;
            case '-55':
                $message = "??????????????????";
                $exception = new ChipManufacturerException($result, $message, $action);
                break;
            case '-56':
                $message = "??????????????????";
                $exception = new ChipTypeException($result, $message, $action);
                break;
            case '-57':
                $message = "??????????????????";
                $exception = new AlgorithmManufacturerException($result, $message, $action);
                break;
            case '-58':
                $message = "??????????????????";
                $exception = new AlgorithmTypeException($result, $message, $action);
                break;
            case '-59':
                $message = "??????????????????";
                $exception = new DeviceTypeException($result, $message, $action);
                break;
            case '-60':
                $message = "??????????????????";
                $exception = new AlgorithmVersionException($result, $message, $action);
                break;
            case '-61':
                $message = "?????????????????????";
                $exception = new DatabaseOperationException($result, $message, $action);
                break;
            case '-62':
                $message = "????????????";
                $exception = new FaceDetectionException($result, $message, $action);
                break;
            case '-5102':
                $message = "Plan???????????????";
                $exception = new PlanFieldErrorException($result, $message, $action);
                break;
            case '-5103':
                $message = "Date???????????????";
                $exception = new DateFieldErrorException($result, $message, $action);
                break;
            case '-5104':
                $message = "????????????";
                $exception = new RepeatCheckInException($result, $message, $action);
                break;
            case '-5105':
                $message = "??????????????????????????????";
                $exception = new NoDataException($result, $message, $action);
                break;
            case '-5106':
                $message = "??????????????????";
                $exception = new ThresholdOutOfRangeException($result, $message, $action);
                break;
            case '-5107':
                $message = "??????????????????";
                $exception = new BufferOutOfRangeException($result, $message, $action);
                break;
            default:
                $message = "??????";
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
     * ?????????????????????
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

            $param['Timestamp'] = $request['Timestamp'] ?? time(); // ?????????????????????????????????????????????????????????????????????
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

    // ??????????????????
    private function createConnect()
    {
        $prot = $this->profile->getHttpProfile()->getProtocol();
        return new HttpConnection($prot.$this->getRefreshedEndpoint(), $this->profile);
    }

    // ?????????????????????????????????????????????????????????????????????????????????
    private function getConnect() {
        $keepAlive = $this->profile->getHttpProfile()->getKeepAlive();
        if (true === $keepAlive) {
            return $this->httpConn;
        } else {
            return $this->createConnect();
        }
    }

    /**
     * ????????????????????????
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
     * ????????????????????????????????????????????????????????????????????????
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
     * ????????????URL
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