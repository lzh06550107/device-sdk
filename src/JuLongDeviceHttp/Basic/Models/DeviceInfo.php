<?php
/**
 * 文件描述
 * Created on 2021/12/24 19:07
 * Create by LZH
 */

namespace JuLongDeviceHttp\Basic\Models;

use JuLongDeviceHttp\Common\AbstractModel;

class DeviceInfo extends AbstractModel
{
    public $DeviceId;
    public $DeviceMac;
    public $DeviceIP;
    public $WIFIAddress;
    public $DeviceAddress;
    public $DeviceDirection;
    public $DeviceType;
    public $AlgorithmicVersion;
    public $ModelVersion;
    public $WebVersion;
    public $CoreVersion;
    public $VersionDate;
    public $HTTPVersion;
    public $HTTPDate;

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("DeviceId",$param) and $param["DeviceId"] !== null) {
            $this->DeviceId = $param["DeviceId"];
        }

        if (array_key_exists("DeviceMac",$param) and $param["DeviceMac"] !== null) {
            $this->DeviceMac = $param["DeviceMac"];
        }

        if (array_key_exists("DeviceIP",$param) and $param["DeviceIP"] !== null) {
            $this->DeviceIP = $param["DeviceIP"];
        }

        if (array_key_exists("WIFIAddress",$param) and $param["WIFIAddress"] !== null) {
            $this->WIFIAddress = $param["WIFIAddress"];
        }

        if (array_key_exists("DeviceAddress",$param) and $param["DeviceAddress"] !== null) {
            $this->DeviceAddress = $param["DeviceAddress"];
        }

        if (array_key_exists("DeviceDirection",$param) and $param["DeviceDirection"] !== null) {
            $this->DeviceDirection = $param["DeviceDirection"];
        }

        if (array_key_exists("DeviceType",$param) and $param["DeviceType"] !== null) {
            $this->DeviceType = $param["DeviceType"];
        }

        if (array_key_exists("AlgorithmicVersion",$param) and $param["AlgorithmicVersion"] !== null) {
            $this->AlgorithmicVersion = $param["AlgorithmicVersion"];
        }

        if (array_key_exists("ModelVersion",$param) and $param["ModelVersion"] !== null) {
            $this->ModelVersion = $param["ModelVersion"];
        }

        if (array_key_exists("WebVersion",$param) and $param["WebVersion"] !== null) {
            $this->WebVersion = $param["WebVersion"];
        }

        if (array_key_exists("CoreVersion",$param) and $param["CoreVersion"] !== null) {
            $this->CoreVersion = $param["CoreVersion"];
        }

        if (array_key_exists("VersionDate",$param) and $param["VersionDate"] !== null) {
            $this->VersionDate = $param["VersionDate"];
        }

        if (array_key_exists("HTTPVersion",$param) and $param["HTTPVersion"] !== null) {
            $this->HTTPVersion = $param["HTTPVersion"];
        }

        if (array_key_exists("HTTPDate",$param) and $param["HTTPDate"] !== null) {
            $this->HTTPDate = $param["HTTPDate"];
        }

    }

}