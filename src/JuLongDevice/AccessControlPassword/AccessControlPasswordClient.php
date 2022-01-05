<?php

namespace JuLongDevice\AccessControlPassword;

use JuLongDevice\Common\AbstractClient;
use JuLongDevice\Common\Exception\DeviceSDKException;
use JuLongDevice\Common\Profile\ClientProfile;

/**
 * 管理门禁密码接口
 * Created on 2022/1/4 10:22
 * Create by LZH
 *
 * @method Models\PasswordListResponse passwordList(Models\PasswordListRequest $req) 本接口用于管理门禁密码
 */
class AccessControlPasswordClient extends AbstractClient
{
    /**
     * @var string
     */
    protected $service = "accessControlPassword";

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
        $respClass = "JuLongDevice"."\\".ucfirst($this->service)."\\"."Models"."\\".ucfirst($action)."Response";
        $obj = new $respClass();
        $obj->deserialize($response);
        return $obj;
    }
}