<?php

namespace JuLongDevice\Common;

use JuLongDevice\Common\Exception\DeviceSDKException;
use JuLongDevice\Common\Http\HttpConnection;
use JuLongDevice\Common\Profile\ClientProfile;
use JuLongDevice\Common\Profile\HttpProfile;
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
                throw new DeviceSDKException($tmpResp["Code"], $tmpResp["Message"], $tmpResp["Name"]);
            } else if (array_key_exists('ErrorCode', $tmpResp) && $tmpResp['ErrorCode'] == 0) {
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
        $param['Name'] = ucfirst($action);
        $clientProfile = $this->getClientProfile();
        if($clientProfile->getSignMethod()) {

            $param['Timestamp'] = time();
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