<?php

namespace JuLongDeviceHttp\Common\Profile;

use JuLongDeviceHttp\HttpClientBuilder;

/**
 * client可选参数类
 * Created on 2021/12/23 9:55
 * Create by LZH
 */
class ClientProfile
{

    /**
     * @var string  hmacsha1算法
     */
    public static $SIGN_HMAC_SHA1 = "HmacSHA1";

    /**
     * @var string hmacsha256算法
     */
    public static $SIGN_HMAC_SHA256 = "HmacSHA256";

    /**
     * @var string md5算法
     */
    public static $SIGN_MD5 = "Md5";

    /**
     * @var string UUID 从设备后台获取
     */
    private $UUID;

    /**
     * @var HttpProfile http相关参数
     */
    private $httpProfile;

    /**
     * @var string 签名方法
     */
    private $signMethod;

    /**
     * @var boolean
     */
    private $checkPHPVersion;

    /**
     * @var string 设备登录用户名称
     */
    private $deviceAdmin;

    /**
     * @var string 设备登录密码
     */
    private $devicePassword;

    /**
     * @var HttpClientBuilder 构建器对象，目的是链式配置的时候可以回退
     */
    private $deviceClientBuilder;

    /**
     * ClientProfile constructor.
     * @param string $signMethod  签名算法，目前支持SHA256，SHA1
     * @param HttpProfile $httpProfile http参数类
     */
    public function __construct($signMethod = null, $httpProfile = null)
    {
        $this->signMethod = ''; // 默认没有签名
        $this->httpProfile = $httpProfile ? $httpProfile : new HttpProfile();
        $this->unsignedPayload = false;
        $this->checkPHPVersion = true;
        //$this->language = ClientProfile::$ZH_CN;
    }

    /**
     * 设置签名算法
     * @param string $signMethod 签名方法，目前支持SHA256，SHA1, TC3
     */
    public function setSignMethod($signMethod)
    {
        $this->signMethod = $signMethod;
        return $this;
    }

    /**
     * 设置http相关参数
     * @param HttpProfile $httpProfile http相关参数
     */
    public function setHttpProfile($httpProfile)
    {
        $this->httpProfile = $httpProfile;
        return $this;
    }

    /**
     * @return string
     */
    public function getUUID(): string
    {
        return $this->UUID;
    }

    /**
     * @param string $UUID
     */
    public function setUUID(string $UUID)
    {
        $this->UUID = $UUID;
        return $this;
    }

    /**
     * 获取签名方法
     * @return null|string 签名方法
     */
    public function getSignMethod()
    {
        return $this->signMethod;
    }

    public function getCheckPHPVersion()
    {
        return $this->checkPHPVersion;
    }

    public function setCheckPHPVersion($flag)
    {
        $this->checkPHPVersion = $flag;
        return $this;
    }

    /**
     * 获取http选项实例
     * @return null|HttpProfile http选项实例
     */
    public function getHttpProfile()
    {
        return $this->httpProfile;
    }


    /**
     * @return string
     */
    public function getDeviceAdmin(): string
    {
        return $this->deviceAdmin;
    }

    /**
     * @param string $deviceAdmin
     */
    public function setDeviceAdmin(string $deviceAdmin)
    {
        $this->deviceAdmin = $deviceAdmin;
        return $this;
    }

    /**
     * @return string
     */
    public function getDevicePassword(): string
    {
        return $this->devicePassword;
    }

    /**
     * @param string $devicePassword
     */
    public function setDevicePassword(string $devicePassword)
    {
        $this->devicePassword = $devicePassword;
        return $this;
    }

    /**
     * @param HttpClientBuilder $deviceClientBuilder
     */
    public function setDeviceClientBuilder(HttpClientBuilder $deviceClientBuilder): void
    {
        $this->deviceClientBuilder = $deviceClientBuilder;
    }

    /**
     * 回退到DeviceClientBuilder对象继续配置
     * @return HttpClientBuilder
     */
    public function back() : HttpClientBuilder {
        return $this->deviceClientBuilder;
    }

}