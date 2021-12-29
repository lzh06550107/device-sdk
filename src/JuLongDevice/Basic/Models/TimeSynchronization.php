<?php
/**
 * 文件描述
 * Created on 2021/12/28 11:07
 * Create by LZH
 */

namespace JuLongDevice\Basic\Models;

use JuLongDevice\Common\AbstractModel;

// 时间同步
class TimeSynchronization extends AbstractModel
{
    public $TimeMode;
    public $LocalTime;

    public function deserialize($param) {

        if ($param === null) {
            return;
        }

        if (array_key_exists("TimeMode",$param) and $param["TimeMode"] !== null) {
            $this->TimeMode = $param["TimeMode"];
        }

        if (array_key_exists("LocalTime",$param) and $param["LocalTime"] !== null) {
            $this->LocalTime = $param["LocalTime"];
        }

    }
}