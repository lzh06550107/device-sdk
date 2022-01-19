<?php

namespace JuLongDeviceHttp\FaceManage;

use JuLongDeviceHttp\Common\AbstractClient;
use JuLongDeviceHttp\Common\Exception\DeviceSDKException;
use JuLongDeviceHttp\Common\Profile\ClientProfile;

/**
 * 名单库管理
 * Created on 2021/12/28 13:54
 * Create by LZH
 *
 * @method Models\PersonListResponse personList(Models\PersonListRequest $req) 本接口用于对应的请求结果
 */
class FaceManageClient extends AbstractClient
{
    /**
     * @var string
     */
    protected $service = "faceManage";

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