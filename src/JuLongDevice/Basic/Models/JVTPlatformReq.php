<?php
/**
 * 文件描述
 * Created on 2021/12/24 11:25
 * Create by LZH
 */

namespace JuLongDevice\Basic\Models;

use JuLongDevice\Common\AbstractModel;

/**
 * 激活设备请求数据
 * Created on 2021/12/24 11:27
 * Create by LZH
 */
class JVTPlatformReq extends AbstractModel
{
    public $DomainName;
    public $Port;
    public $RegisterPath;
    public $HeartbeatPath;
    public $CaptureInfoPath;
    public $DeviceSN;
    public $DeviceAdmin;
    public $DevicePassword;
    public $MiddleWareAddress;

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("DomainName",$param) and $param["DomainName"] !== null) {
            $this->DomainName = $param["DomainName"];
        }

        if (array_key_exists("Port",$param) and $param["Port"] !== null) {
            $this->Port = $param["Port"];
        }

        if (array_key_exists("RegisterPath",$param) and $param["RegisterPath"] !== null) {
            $this->RegisterPath = $param["RegisterPath"];
        }

        if (array_key_exists("HeartbeatPath",$param) and $param["HeartbeatPath"] !== null) {
            $this->HeartbeatPath = $param["HeartbeatPath"];
        }

        if (array_key_exists("CaptureInfoPath",$param) and $param["CaptureInfoPath"] !== null) {
            $this->CaptureInfoPath = $param["CaptureInfoPath"];
        }

        if (array_key_exists("DeviceSN",$param) and $param["DeviceSN"] !== null) {
            $this->DeviceSN = $param["DeviceSN"];
        }

        if (array_key_exists("DeviceAdmin",$param) and $param["DeviceAdmin"] !== null) {
            $this->DeviceAdmin = $param["DeviceAdmin"];
        }

        if (array_key_exists("DevicePassword",$param) and $param["DevicePassword"] !== null) {
            $this->DevicePassword = $param["DevicePassword"];
        }

        if (array_key_exists("MiddleWareAddress",$param) and $param["MiddleWareAddress"] !== null) {
            $this->MiddleWareAddress = $param["MiddleWareAddress"];
        }

    }
}