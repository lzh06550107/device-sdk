<?php
/**
 * 文件描述
 * Created on 2021/12/27 18:12
 * Create by LZH
 */

namespace JuLongDeviceHttp\ParamSetting\Models;

use JuLongDeviceHttp\Common\AbstractResponse;

class GetTimeParametersResponse extends AbstractResponse
{
    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {

            $getTimeParameters = new TimeParameters();
            $getTimeParameters->deserialize($param["Data"]);

            $this->Data = $getTimeParameters;
        }

    }
}