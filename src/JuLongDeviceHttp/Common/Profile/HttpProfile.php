<?php

namespace JuLongDeviceHttp\Common\Profile;

use JuLongDeviceHttp\DeviceClientBuilder;

/**
 * http相关参数类
 * Created on 2021/12/23 9:55
 * Create by LZH
 */
class HttpProfile
{

    /**
     * @var string https访问
     */
    public static $REQ_HTTPS = "https://";

    /**
     * @var string http访问
     */
    public static $REQ_HTTP = "http://";

    /**
     * @var string  post请求
     */
    public static $REQ_POST = "POST";

    /**
     * @var string  get请求
     */
    public static $REQ_GET = "GET";

    /**
     * @var int 时间一分钟
     */
    public static $TM_MINUTE = 60;

    /**
     * @var string http请求方法
     */
    private $reqMethod;

    /**
     * @var string 请求接入点域名
     */
    private $endpoint;

    /**
     * @var integer 请求超时时长，单位为秒
     */
    private $reqTimeout;

    /**
     * @var string 请求协议
     */
    private $protocol;

    /**
     * @var string|array 请求代理
     */
    private $proxy;

    /**
     * @var string
     */
    private $rootDomain;

    /**
     * @var boolean
     */
    private $keepAlive;

    /**
     * @var DeviceClientBuilder 构建器对象，目的是链式配置的时候可以回退
     */
    private $deviceClientBuilder;

    /**
     * HttpProfile constructor.
     * @param string $protocol  请求协议
     * @param string $reqMethod http请求方法，目前支持POST GET
     * @param integer $reqTimeout 请求超时时间，单位:s
     */
    public function __construct($protocol = null, $reqMethod = null,  $reqTimeout = null)
    {
        $this->reqMethod = $reqMethod ? $reqMethod : HttpProfile::$REQ_POST;
        $this->reqTimeout = $reqTimeout ? $reqTimeout : HttpProfile::$TM_MINUTE;
        $this->protocol = $protocol ? $protocol : HttpProfile::$REQ_HTTPS;
        $this->rootDomain = "xxxapi.com";
        $this->keepAlive = false;
    }

    /**
     * 设置http请求方法
     * @param string $reqMethod http请求方法，目前支持POST GET
     */
    public function setReqMethod($reqMethod)
    {
        $this->reqMethod = $reqMethod;
        return $this;
    }

    /**
     * 设置请求接入点域名
     * @param string $endpoint 请求链接
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * 设置请求协议
     * @param string $protocol 请求协议（https://  http://）
     */
    public function setProtocol($protocol) {
        $this->protocol = $protocol;
        return $this;
    }

    /**
     * 设置请求超时时间
     * @param integer $reqTimeout 请求超时时间，单位:s
     */
    public function setReqTimeout($reqTimeout)
    {
        $this->reqTimeout = $reqTimeout;
        return $this;
    }

    /**
     * 设置请求代理
     * @param string|array $proxy 请求代理配置
     */
    public function setProxy($proxy)
    {
        $this->proxy = $proxy;
        return $this;
    }

    /**
     * 获取请求方法
     * @return null|string 请求方法
     */
    public function getReqMethod()
    {
        return $this->reqMethod;
    }

    /**
     * 获取请求协议
     * @return null|string 请求协议
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * 获取请求超时时间
     * @return int 请求超时时间
     */
    public function getReqTimeout()
    {
        return $this->reqTimeout;
    }

    /**
     * 获取请求代理
     * @return null|string|array
     */
    public function getProxy()
    {
        return $this->proxy;
    }

    public function setRootDomain($domain)
    {
        $this->rootDomain = $domain;
    }

    public function getRootDomain()
    {
        return $this->rootDomain;
    }

    /**
     * @param boolean $flag
     */
    public function setKeepAlive($flag) {
        $this->keepAlive = $flag;
    }

    public function getKeepAlive() {
        return $this->keepAlive;
    }

    /**
     * 获取请求接入点域名
     * @return null|string 接入点域名
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param DeviceClientBuilder $deviceClientBuilder
     */
    public function setDeviceClientBuilder(DeviceClientBuilder $deviceClientBuilder): void
    {
        $this->deviceClientBuilder = $deviceClientBuilder;
    }

    /**
     * 回退到DeviceClientBuilder对象继续配置
     * @return DeviceClientBuilder
     */
    public function back() : DeviceClientBuilder {
        return $this->deviceClientBuilder;
    }

}