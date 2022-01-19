<?php
/**
 * 文件描述
 * Created on 2021/12/28 11:22
 * Create by LZH
 */

namespace JuLongDeviceHttp\Basic\Models;

use JuLongDeviceHttp\Common\AbstractModel;

// 定时重启
class RestartTime extends AbstractModel
{
    public $Action;
    public $Enable;
    public $Week;
    public $Hour;

    public function deserialize($param) {

        if ($param === null) {
            return;
        }

        if (array_key_exists("Action",$param) and $param["Action"] !== null) {
            $this->Action = $param["Action"];
        }

        if (array_key_exists("Enable",$param) and $param["Enable"] !== null) {
            $this->Enable = $param["Enable"];
        }

        if (array_key_exists("Week",$param) and $param["Week"] !== null) {
            $this->Week = $param["Week"];
        }

        if (array_key_exists("Hour",$param) and $param["Hour"] !== null) {
            $this->Hour = $param["Hour"];
        }

    }
}