<?php
/**
 * 文件描述
 * Created on 2021/12/28 9:07
 * Create by LZH
 */

namespace JuLongDevice\ParamSetting\Models;

use JuLongDevice\Common\AbstractModel;

// SIM卡（4G/5G）参数
class SIMCard extends AbstractModel
{
    public $Enabled;
    public $Strength;
    public $Type;
    public $ConnectStatus;
    public $CardStatus;
    public $ServiceStatus;
    public $NetworkMode;
    public $SoftwareVersion;
    public $HardwareVersion;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("Enabled",$param) and $param["Enabled"] !== null) {
            $this->Enabled = $param['Enabled'];
        }

        if (array_key_exists("Strength",$param) and $param["Strength"] !== null) {
            $this->Strength = $param['Strength'];
        }

        if (array_key_exists("Type",$param) and $param["Type"] !== null) {
            $this->Type = $param['Type'];
        }

        if (array_key_exists("ConnectStatus",$param) and $param["ConnectStatus"] !== null) {
            $this->ConnectStatus = $param['ConnectStatus'];
        }

        if (array_key_exists("CardStatus",$param) and $param["CardStatus"] !== null) {
            $this->CardStatus = $param['CardStatus'];
        }

        if (array_key_exists("ServiceStatus",$param) and $param["ServiceStatus"] !== null) {
            $this->ServiceStatus = $param['ServiceStatus'];
        }

        if (array_key_exists("NetworkMode",$param) and $param["NetworkMode"] !== null) {
            $this->NetworkMode = $param['NetworkMode'];
        }

        if (array_key_exists("SoftwareVersion",$param) and $param["SoftwareVersion"] !== null) {
            $this->SoftwareVersion = $param['SoftwareVersion'];
        }

        if (array_key_exists("HardwareVersion",$param) and $param["HardwareVersion"] !== null) {
            $this->HardwareVersion = $param['HardwareVersion'];
        }

    }
}