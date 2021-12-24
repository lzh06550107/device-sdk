<?php

namespace JuLongDevice\Basic;

use JuLongDevice\Common\AbstractClient;
use JuLongDevice\Common\Credential;
use JuLongDevice\Common\Exception\DeviceSDKException;
use JuLongDevice\Common\Profile\ClientProfile;

/**
 * 设备基础操作
 * Created on 2021/12/23 10:54
 * Create by LZH
 *
 * @method Models\JVTPlatformReqResponse JVTPlatformReq(Models\JVTPlatformReqRequest $req) 本接口用于激活设备。
 */
class BasicClient extends AbstractClient
{
    /**
     * @var string
     */
    protected $service = "basic";

    /**
     * @var string
     */
    protected $version = "2021-09-08";

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
        $respClass = "JuLongDevice"."\\".ucfirst($this->service)."\\"."Models"."\\".ucfirst($action)."Response";
        $obj = new $respClass();
        $obj->deserialize($response);
        return $obj;
    }
}