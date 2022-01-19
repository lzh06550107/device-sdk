<?php
/**
 * 文件描述
 * Created on 2021/12/31 10:59
 * Create by LZH
 */

namespace JuLongDeviceHttp\AccessStrategy\Models;

class AddStrategysResponse
{
    /**
     * @var string 动作
     */
    public $Action;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("Action",$param) and $param["Action"] !== null) {
            $this->Action = $param['Action'];
        }

    }
}