<?php
/**
 * 文件描述
 * Created on 2021/12/27 18:31
 * Create by LZH
 */

namespace JuLongDeviceHttp\ParamSetting\Models;

use JuLongDeviceHttp\Common\AbstractResponse;

class GetAudioParametersResponse extends AbstractResponse
{
    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {

            $getAudioParameters = new AudioParameters();
            $getAudioParameters->deserialize($param["Data"]);

            $this->Data = $getAudioParameters;
        }

    }
}