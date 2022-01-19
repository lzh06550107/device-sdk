<?php
/**
 * 文件描述
 * Created on 2021/12/28 11:45
 * Create by LZH
 */

namespace JuLongDeviceHttp\Basic\Models;

use JuLongDeviceHttp\Common\AbstractModel;

// 升级设备
class UpgradeDevice extends AbstractModel
{
    public $Version;
    public $Url;

    public function deserialize($param) {

        if ($param === null) {
            return;
        }

        if (array_key_exists("Version",$param) and $param["Version"] !== null) {
            $this->Version = $param["Version"];
        }

        if (array_key_exists("Url",$param) and $param["Url"] !== null) {
            $this->Url = $param["Url"];
        }

    }
}