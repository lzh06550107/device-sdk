<?php
/**
 * 文件描述
 * Created on 2021/12/27 10:22
 * Create by LZH
 */

namespace JuLongDeviceHttp\ParamSetting\Models;

use JuLongDeviceHttp\Common\AbstractResponse;

class SetHTTPParametersResponse extends AbstractResponse
{
    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {

            $getHTTPParameters = new HTTPParameters();
            $getHTTPParameters->deserialize($param["Data"]);

            $this->Data = $getHTTPParameters;
        }

    }
}