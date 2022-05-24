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
     * @param $clientProfile
     * @return BasicClient
     * @throws Common\Exception\DeviceSDKException
     * @author LZH
     * @since 2022/01/20
     */
    public function getBaseClient($clientProfile = null): BasicClient
    {
        if (empty($clientProfile)) {
            $this->clientProfile->setHttpProfile($this->httpProfile);
        }
        return new BasicClient($clientProfile ?: $this->clientProfile);
    }

    /**
     * @param $clientProfile
     * @return AccessControlPasswordClient
     * @throws Common\Exception\DeviceSDKException
     * @author LZH
     * @since 2022/01/20
     */
    public function getAccessControlPasswordClient($clientProfile = null): AccessControlPasswordClient
    {
        if (empty($clientProfile)) {
            $this->clientProfile->setHttpProfile($this->httpProfile);
        }
        return new AccessControlPasswordClient($clientProfile ?: $this->clientProfile);
    }

    /**
     * @param $clientProfile
     * @return AccessStrategyClient
     * @throws Common\Exception\DeviceSDKException
     * @author LZH
     * @since 2022/01/20
     */
    public function getAccessStrategyClient($clientProfile = null): AccessStrategyClient
    {
        if (empty($clientProfile)) {
            $this->clientProfile->setHttpProfile($this->httpProfile);
        }
        return new AccessStrategyClient($clientProfile ?: $this->clientProfile);
    }

    /**
     * @param $clientProfile
     * @return FaceCompareClient
     * @throws Common\Exception\DeviceSDKException
     * @author LZH
     * @since 2022/01/20
     */
    public function getFaceCompareClient($clientProfile = null): FaceCompareClient
    {
        if (empty($clientProfile)) {
            $this->clientProfile->setHttpProfile($this->httpProfile);
        }
        return new FaceCompareClient($clientProfile ?: $this->clientProfile);
    }

    /**
     * @param $clientProfile
     * @return FaceManageClient
     * @throws Common\Exception\DeviceSDKException
     * @author LZH
     * @since 2022/01/20
     */
    public function getFaceManageClient($clientProfile = null): FaceManageClient
    {
        if (empty($clientProfile)) {
            $this->clientProfile->setHttpProfile($this->httpProfile);
        }
        return new FaceManageClient($clientProfile ?: $this->clientProfile);
    }

    /**
     * @param $clientProfile
     * @return HealthCodeClient
     * @throws Common\Exception\DeviceSDKException
     * @author LZH
     * @since 2022/01/20
     */
    public function getHealthCodeClient($clientProfile = null): HealthCodeClient
    {
        if (empty($clientProfile)) {
            $this->clientProfile->setHttpProfile($this->httpProfile);
        }
        return new HealthCodeClient($clientProfile ?: $this->clientProfile);
    }

    /**
     * @param $clientProfile
     * @return NVRManageClient
     * @throws Common\Exception\DeviceSDKException
     * @author LZH
     * @since 2022/01/20
     */
    public function getNVRManageClient($clientProfile = null): NVRManageClient
    {
        if (empty($clientProfile)) {
            $this->clientProfile->setHttpProfile($this->httpProfile);
        }
        return new NVRManageClient($clientProfile ?: $this->clientProfile);
    }

    /**
     * @param $clientProfile
     * @return ParamSettingClient
     * @throws Common\Exception\DeviceSDKException
     * @author LZH
     * @since 2022/01/20
     */
    public function getParamSettingClient($clientProfile = null): ParamSettingClient
    {
        if (empty($clientProfile)) {
            $this->clientProfile->setHttpProfile($this->httpProfile);
        }
        return new ParamSettingClient($clientProfile ?: $this->clientProfile);
    }

}