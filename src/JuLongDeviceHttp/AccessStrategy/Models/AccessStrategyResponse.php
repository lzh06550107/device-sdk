<?php

namespace JuLongDeviceHttp\AccessStrategy\Models;

use JuLongDeviceHttp\Common\AbstractResponse;

/**
 * 文件描述
 * Created on 2021/12/31 10:13
 * Create by LZH
 */
class AccessStrategyResponse extends AbstractResponse
{
    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {

            $respClass = "JuLongDeviceHttp\\AccessStrategy\\Models"."\\".ucfirst($param["Data"]["Action"])."Response";
            $obj = new $respClass();
            $obj->deserialize($param["Data"]);
            $this->Data = $obj;
        }

    }
}