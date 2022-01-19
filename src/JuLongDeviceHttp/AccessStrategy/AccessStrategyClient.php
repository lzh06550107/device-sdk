<?php

namespace JuLongDeviceHttp\AccessStrategy;

use JuLongDeviceHttp\Common\AbstractClient;
use JuLongDeviceHttp\Common\Exception\DeviceSDKException;
use JuLongDeviceHttp\Common\Profile\ClientProfile;

/**
 * 通行策略管理接口
 * Created on 2021/12/31 10:00
 * Create by LZH
 *
 * @method Models\AccessStrategyResponse accessStrategy(Models\AccessStrategyRequest $req) 本接口用于操作访问策略相关接口
 * @method Models\IdentityChangeResponse identityChange(Models\IdentityChangeRequest $req) 本接口用于人员身份替换（人员换组）
 */
class AccessStrategyClient extends AbstractClient
{
    /**
     * @var string
     */
    protected $service = "accessStrategy";

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