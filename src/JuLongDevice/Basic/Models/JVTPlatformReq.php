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
    public $domainName;
    public $port;
    public $registerPath;
    public $heartbeatPath;
    public $captureInfoPath;
    public $deviceSN;
    public $deviceAdmin;
    public $devicePassword;
    public $middleWareAddress;

    public function deserialize($param) {

        parent::deserialize();

        if ($param === null) {
            return;
        }

        if (array_key_exists("DomainName",$param) and $param["DomainName"] !== null) {
            $this->Message = $param["DomainName"];
        }

        if (array_key_exists("Port",$param) and $param["Port"] !== null) {
            $this->Message = $param["Port"];
        }

        if (array_key_exists("RegisterPath",$param) and $param["RegisterPath"] !== null) {
            $this->Message = $param["RegisterPath"];
        }

        if (array_key_exists("HeartbeatPath",$param) and $param["HeartbeatPath"] !== null) {
            $this->Message = $param["HeartbeatPath"];
        }

        if (array_key_exists("CaptureInfoPath",$param) and $param["CaptureInfoPath"] !== null) {
            $this->Message = $param["CaptureInfoPath"];
        }

        if (array_key_exists("DeviceSN",$param) and $param["DeviceSN"] !== null) {
            $this->Message = $param["DeviceSN"];
        }

        if (array_key_exists("DeviceAdmin",$param) and $param["DeviceAdmin"] !== null) {
            $this->Message = $param["DeviceAdmin"];
        }

        if (array_key_exists("DevicePassword",$param) and $param["DevicePassword"] !== null) {
            $this->Message = $param["DevicePassword"];
        }

        if (array_key_exists("MiddleWareAddress",$param) and $param["MiddleWareAddress"] !== null) {
            $this->Message = $param["MiddleWareAddress"];
        }

    }
}