<?php

namespace JuLongDeviceHttp\HealthCode;

use JuLongDeviceHttp\Common\AbstractClient;
use JuLongDeviceHttp\Common\Exception\DeviceSDKException;
use JuLongDeviceHttp\Common\Profile\ClientProfile;

/**
 * 健康码信息接口
 * Created on 2022/1/4 13:46
 * Create by LZH
 *
 * @method Models\GetHealthCodeResponse getHealthCode(Models\GetHealthCodeRequest $req) 本接口用于获取健康码
 */
class HealthCodeClient extends AbstractClient
{
    /**
     * @var string
     */
    protected $service = "healthCode";

    /**
     * @var string
     */
    protected $version = "2021-12-23";

    /**
     * @param ClientProfile|null $profile
     * @throws DeviceSDKException
     */
    function __construct($profile=null)
    {
        parent::__construct($profile);
    }

    public function returnResponse($action, $response)
    {
        $respClass = "JuLongDeviceHttp"."\\".ucfirst($this->service)."\\"."Models"."\\".ucfirst($action)."Response";
        $obj = new $respClass();
        $obj->deserialize($response);
        return $obj;
    }
}