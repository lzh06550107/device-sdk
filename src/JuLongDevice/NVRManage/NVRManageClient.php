<?php

namespace JuLongDevice\NVRManage;

use JuLongDevice\Common\AbstractClient;
use JuLongDevice\Common\Exception\DeviceSDKException;
use JuLongDevice\Common\Profile\ClientProfile;

/**
 * NVR管理接口
 * Created on 2022/1/4 9:00
 * Create by LZH
 *
 * @method Models\SearchVideoResponse searchVideo(Models\SearchVideoRequest $req) 本接口用于搜索录像列表（仅NVR支持）
 * @method Models\SearchPictureResponse searchPicture(Models\SearchPictureRequest $req) 本接口用于搜索图片列表（仅NVR支持）
 */
class NVRManageClient extends AbstractClient
{
    /**
     * @var string
     */
    protected $service = "NVRManage";

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