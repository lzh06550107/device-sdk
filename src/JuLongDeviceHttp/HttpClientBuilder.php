<?php
/**
 * 文件描述
 * Created on 2022/1/19 16:28
 * Create by LZH
 */

namespace JuLongDeviceHttp;

use JuLongDeviceHttp\AccessControlPassword\AccessControlPasswordClient;
use JuLongDeviceHttp\AccessStrategy\AccessStrategyClient;
use JuLongDeviceHttp\Basic\BasicClient;
use JuLongDeviceHttp\Common\Profile\ClientProfile;
use JuLongDeviceHttp\Common\Profile\HttpProfile;
use JuLongDeviceHttp\FaceCompare\FaceCompareClient;
use JuLongDeviceHttp\FaceManage\FaceManageClient;
use JuLongDeviceHttp\HealthCode\HealthCodeClient;
use JuLongDeviceHttp\NVRManage\NVRManageClient;
use JuLongDeviceHttp\ParamSetting\ParamSettingClient;

// 设备客户端构建器
final class HttpClientBuilder
{

    /**
     * @var HttpProfile http请求相关的配置
     */
    private HttpProfile $httpProfile;
    /**
     * @var ClientProfile 客户端请求相关的配置
     */
    private ClientProfile $clientProfile;

    public static function builder() : HttpClientBuilder
    {
        return new HttpClientBuilder();
    }

    /**
     * @return HttpProfile
     */
    public function getHttpProfile(): HttpProfile
    {
        if (empty($this->httpProfile)) {
            $this->httpProfile = new HttpProfile();
        }
        $this->httpProfile->setDeviceClientBuilder($this);
        return $this->httpProfile;
    }

    /**
     * @param HttpProfile $httpProfile
     * @return HttpClientBuilder
     */
    public function setHttpProfile(HttpProfile $httpProfile): HttpClientBuilder
    {
        $this->httpProfile = $httpProfile;
        return $this;
    }

    /**
     * @return ClientProfile
     */
    public function getClientProfile(): ClientProfile
    {
        if (empty($this->clientProfile)) {
            $this->clientProfile = new ClientProfile();
        }
        $this->clientProfile->setDeviceClientBuilder($this);
        return $this->clientProfile;
    }

    /**
     * @param ClientProfile $clientProfile
     * @return HttpClientBuilder
     */
    public function setClientProfile(ClientProfile $clientProfile): HttpClientBuilder
    {
        $this->clientProfile = $clientProfile;
        return $this;
    }

    /**
     * @throws Common\Exception\DeviceSDKException
     */
    public function getBaseClient(): BasicClient
    {
        $this->clientProfile->setHttpProfile($this->httpProfile);
        return new BasicClient($this->clientProfile);
    }

    /**
     * @throws Common\Exception\DeviceSDKException
     */
    public function getAccessControlPasswordClient(): AccessControlPasswordClient
    {
        $this->clientProfile->setHttpProfile($this->httpProfile);
        return new AccessControlPasswordClient($this->clientProfile);
    }

    /**
     * @throws Common\Exception\DeviceSDKException
     */
    public function getAccessStrategyClient(): AccessStrategyClient
    {
        $this->clientProfile->setHttpProfile($this->httpProfile);
        return new AccessStrategyClient($this->clientProfile);
    }

    /**
     * @throws Common\Exception\DeviceSDKException
     */
    public function getFaceCompareClient(): FaceCompareClient
    {
        $this->clientProfile->setHttpProfile($this->httpProfile);
        return new FaceCompareClient($this->clientProfile);
    }

    /**
     * @throws Common\Exception\DeviceSDKException
     */
    public function getFaceManageClient(): FaceManageClient
    {
        $this->clientProfile->setHttpProfile($this->httpProfile);
        return new FaceManageClient($this->clientProfile);
    }

    /**
     * @throws Common\Exception\DeviceSDKException
     */
    public function getHealthCodeClient(): HealthCodeClient
    {
        $this->clientProfile->setHttpProfile($this->httpProfile);
        return new HealthCodeClient($this->clientProfile);
    }

    /**
     * @throws Common\Exception\DeviceSDKException
     */
    public function getNVRManageClient(): NVRManageClient
    {
        $this->clientProfile->setHttpProfile($this->httpProfile);
        return new NVRManageClient($this->clientProfile);
    }

    /**
     * @throws Common\Exception\DeviceSDKException
     */
    public function getParamSettingClient(): ParamSettingClient
    {
        $this->clientProfile->setHttpProfile($this->httpProfile);
        return new ParamSettingClient($this->clientProfile);
    }

}