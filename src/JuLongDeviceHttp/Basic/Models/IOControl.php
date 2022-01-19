<?php
/**
 * 文件描述
 * Created on 2021/12/28 10:56
 * Create by LZH
 */

namespace JuLongDeviceHttp\Basic\Models;

use JuLongDeviceHttp\Common\AbstractModel;

// IO 控制（远程开门）
class IOControl extends AbstractModel
{
    public $ContinueSeconds;

    public function deserialize($param) {

        if ($param === null) {
            return;
        }

        if (array_key_exists("ContinueSeconds",$param) and $param["ContinueSeconds"] !== null) {
            $this->ContinueSeconds = $param["ContinueSeconds"];
        }

    }
}