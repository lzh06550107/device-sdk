<?php
/**
 * 文件描述
 * Created on 2021/12/28 11:34
 * Create by LZH
 */

namespace JuLongDeviceHttp\Basic\Models;

use JuLongDeviceHttp\Common\AbstractModel;

// 恢复出厂设置
class RestoreFactory extends AbstractModel
{
    public $UserPassword;
    public $Network;

    public function deserialize($param) {

        if ($param === null) {
            return;
        }

        if (array_key_exists("UserPassword",$param) and $param["UserPassword"] !== null) {
            $this->UserPassword = $param["UserPassword"];
        }

        if (array_key_exists("Network",$param) and $param["Network"] !== null) {
            $this->Network = $param["Network"];
        }

    }
}