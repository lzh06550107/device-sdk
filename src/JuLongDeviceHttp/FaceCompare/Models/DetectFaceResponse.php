<?php
/**
 * 文件描述
 * Created on 2021/12/31 9:33
 * Create by LZH
 */

namespace JuLongDeviceHttp\FaceCompare\Models;

use JuLongDeviceHttp\Common\AbstractResponse;

class DetectFaceResponse extends AbstractResponse
{
    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {
            $detectFaceResult = new DetectFaceResult();
            $detectFaceResult->deserialize($param['Data']);
            $this->Data = $detectFaceResult;
        }

    }
}