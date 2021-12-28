<?php
/**
 * 文件描述
 * Created on 2021/12/28 9:49
 * Create by LZH
 */

namespace JuLongDevice\ParamSetting\Models;

use JuLongDevice\Common\AbstractResponse;

class GetGPSParametersResponse extends AbstractResponse
{

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {

            $getGPSParameters = new GPSParameters();
            $getGPSParameters->deserialize($param["Data"]);

            $this->Data = $getGPSParameters;
        }

    }
}