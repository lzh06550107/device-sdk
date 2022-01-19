<?php
/**
 * 文件描述
 * Created on 2021/12/27 9:43
 * Create by LZH
 */

namespace JuLongDeviceHttp\ParamSetting\Models;

use JuLongDeviceHttp\Common\AbstractModel;

// 抓拍信息上传的内容
class CaptureContent extends AbstractModel
{
    public $FaceInfo;
    public $CompareInfo;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("FaceInfo",$param) and $param["FaceInfo"] !== null) {
            $this->FaceInfo = $param['FaceInfo'];
        }

        if (array_key_exists("CompareInfo",$param) and $param["CompareInfo"] !== null) {
            $this->CompareInfo = $param['CompareInfo'];
        }

    }
}