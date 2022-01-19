<?php

namespace JuLongDeviceHttp\FaceCompare;

use JuLongDeviceHttp\Common\AbstractClient;
use JuLongDeviceHttp\Common\Exception\DeviceSDKException;
use JuLongDeviceHttp\Common\Profile\ClientProfile;

/**
 * 人脸比对功能接口
 * Created on 2021/12/30 10:16
 * Create by LZH
 *
 * @method Models\HistoryRecordResponse historyRecord(Models\HistoryRecordRequest $req) 本接口用于获取历史识别记录
 * @method Models\DeleteRecordResponse deleteRecord(Models\DeleteRecordRequest $req) 本接口用于删除历史识别记录
 * @method Models\FaceFeatureValueResponse faceFeatureValue(Models\FaceFeatureValueRequest $req) 本接口用于通过人脸图片获取特征值
 * @method Models\FaceSearchResponse faceSearch(Models\FaceSearchRequest $req) 本接口用于人脸搜索名单库
 * @method Models\FaceSimilarityResponse faceSimilarity(Models\FaceSimilarityRequest $req) 本接口用于获取两张人脸的相似度
 * @method Models\DetectFaceResponse detectFace(Models\DetectFaceRequest $req) 本接口用于检测导入的人脸是否合格
 */
class FaceCompareClient extends AbstractClient
{
    /**
     * @var string
     */
    protected $service = "faceCompare";

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