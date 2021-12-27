<?php
/**
 * 文件描述
 * Created on 2021/12/27 17:48
 * Create by LZH
 */

namespace JuLongDevice\ParamSetting\Models;

use JuLongDevice\Common\AbstractResponse;

class GetNetParametersResponse extends AbstractResponse
{
    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {

            $getNetParameters = new NetParameters();
            $getNetParameters->deserialize($param["Data"]);

            $this->Data = $getNetParameters;
        }

    }
}