<?php
/**
 * 文件描述
 * Created on 2021/12/27 18:49
 * Create by LZH
 */

namespace JuLongDevice\ParamSetting\Models;

use JuLongDevice\Common\AbstractResponse;

class GetMQTTParametersResponse extends AbstractResponse
{
    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {

            $getMQTTParameters = new MQTTParameters();
            $getMQTTParameters->deserialize($param["Data"]);

            $this->Data = $getMQTTParameters;
        }

    }
}