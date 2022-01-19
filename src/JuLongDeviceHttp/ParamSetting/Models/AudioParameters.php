<?php
/**
 * 文件描述
 * Created on 2021/12/27 18:26
 * Create by LZH
 */

namespace JuLongDeviceHttp\ParamSetting\Models;

use JuLongDeviceHttp\Common\AbstractModel;

// 音频参数获取
class AudioParameters extends AbstractModel
{
    public $Enabled;
    public $AudioInput;
    public $AudioFormat;
    public $InputVolume;
    public $OutputVolume;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("Enabled",$param) and $param["Enabled"] !== null) {
            $this->Enabled = $param['Enabled'];
        }

        if (array_key_exists("AudioInput",$param) and $param["AudioInput"] !== null) {
            $this->AudioInput = $param['AudioInput'];
        }

        if (array_key_exists("AudioFormat",$param) and $param["AudioFormat"] !== null) {
            $this->AudioFormat = $param['AudioFormat'];
        }

        if (array_key_exists("InputVolume",$param) and $param["InputVolume"] !== null) {
            $this->InputVolume = $param['InputVolume'];
        }

        if (array_key_exists("OutputVolume",$param) and $param["OutputVolume"] !== null) {
            $this->OutputVolume = $param['OutputVolume'];
        }

    }
}