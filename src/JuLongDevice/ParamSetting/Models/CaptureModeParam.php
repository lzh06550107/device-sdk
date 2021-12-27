<?php
/**
 * 文件描述
 * Created on 2021/12/27 11:09
 * Create by LZH
 */

namespace JuLongDevice\ParamSetting\Models;

use JuLongDevice\Common\AbstractModel;

class CaptureModeParam extends AbstractModel
{
    public $MaxCaptureTimes;
    public $CaptureTimes;
    public $CaptureInterval;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("MaxCaptureTimes",$param) and $param["MaxCaptureTimes"] !== null) {
            $this->MaxCaptureTimes = $param['MaxCaptureTimes'];
        }

        if (array_key_exists("CaptureTimes",$param) and $param["CaptureTimes"] !== null) {
            $this->CaptureTimes = $param['CaptureTimes'];
        }

        if (array_key_exists("CaptureInterval",$param) and $param["CaptureInterval"] !== null) {
            $this->CaptureInterval = $param['CaptureInterval'];
        }

    }

}