<?php
/**
 * 文件描述
 * Created on 2021/12/27 11:56
 * Create by LZH
 */

namespace JuLongDevice\ParamSetting\Models;

use JuLongDevice\Common\AbstractResponse;

class SetFaceParametersResponse extends AbstractResponse
{
    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {

            $faceParameters = new FaceParameters();
            $faceParameters->deserialize($param["Data"]);

            $this->Data = $faceParameters;
        }

    }
}