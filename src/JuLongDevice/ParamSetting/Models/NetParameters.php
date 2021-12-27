<?php
/**
 * 文件描述
 * Created on 2021/12/27 17:46
 * Create by LZH
 */

namespace JuLongDevice\ParamSetting\Models;

use JuLongDevice\Common\AbstractModel;

// 网络参数
class NetParameters extends AbstractModel
{
    public $DHCPEnabled;
    public $IPAddress;
    public $SubNetMask;
    public $Gateway;
    public $DNS1;
    public $DNS2;

    public function deserialize($param) {

        if ($param === null) {
            return;
        }

        if (array_key_exists("DHCPEnabled",$param) and $param["DHCPEnabled"] !== null) {
            $this->DHCPEnabled = $param["DHCPEnabled"];
        }

        if (array_key_exists("IPAddress",$param) and $param["IPAddress"] !== null) {
            $this->IPAddress = $param["IPAddress"];
        }

        if (array_key_exists("SubNetMask",$param) and $param["SubNetMask"] !== null) {
            $this->SubNetMask = $param["SubNetMask"];
        }

        if (array_key_exists("Gateway",$param) and $param["Gateway"] !== null) {
            $this->Gateway = $param["Gateway"];
        }

        if (array_key_exists("DNS1",$param) and $param["DNS1"] !== null) {
            $this->DNS1 = $param["DNS1"];
        }

        if (array_key_exists("DNS2",$param) and $param["DNS2"] !== null) {
            $this->DNS2 = $param["DNS2"];
        }

    }
}