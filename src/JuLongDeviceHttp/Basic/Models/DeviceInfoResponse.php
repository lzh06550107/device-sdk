<?php
/**
 * 文件描述
 * Created on 2021/12/24 18:20
 * Create by LZH
 */

namespace JuLongDeviceHttp\Basic\Models;

use JuLongDeviceHttp\Common\AbstractResponse;

class DeviceInfoResponse extends AbstractResponse
{

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {

            $deviceInfo = new DeviceInfo();
            $deviceInfo->deserialize($param["Data"]);

            $this->Data = $deviceInfo;
        }


    }

}