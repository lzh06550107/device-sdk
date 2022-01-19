<?php
/**
 * 文件描述
 * Created on 2021/12/27 11:06
 * Create by LZH
 */

namespace JuLongDeviceHttp\ParamSetting\Models;

use JuLongDeviceHttp\Common\AbstractModel;

class TimeTable extends AbstractModel
{
    public $TimeEnabled;
    public $TimeBegin;
    public $TimeEnd;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("TimeEnabled",$param) and $param["TimeEnabled"] !== null) {
            $this->TimeEnabled = $param['TimeEnabled'];
        }

        if (array_key_exists("TimeBegin",$param) and $param["TimeBegin"] !== null) {
            $this->TimeBegin = $param['TimeBegin'];
        }

        if (array_key_exists("TimeEnd",$param) and $param["TimeEnd"] !== null) {
            $this->TimeEnd = $param['TimeEnd'];
        }

    }

}