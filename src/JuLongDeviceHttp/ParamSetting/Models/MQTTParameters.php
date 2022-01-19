<?php
/**
 * 文件描述
 * Created on 2021/12/27 18:44
 * Create by LZH
 */

namespace JuLongDeviceHttp\ParamSetting\Models;

use JuLongDeviceHttp\Common\AbstractModel;

// MQTT参数
class MQTTParameters extends AbstractModel
{
    public $Enabled;
    public $Address;
    public $Port;
    public $UserName;
    public $Password;
    public $Topic;
    public $HeartbeatInterval;
    public $ResendEnabled;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("Enabled",$param) and $param["Enabled"] !== null) {
            $this->Enabled = $param['Enabled'];
        }

        if (array_key_exists("Address",$param) and $param["Address"] !== null) {
            $this->Address = $param['Address'];
        }

        if (array_key_exists("Port",$param) and $param["Port"] !== null) {
            $this->Port = $param['Port'];
        }

        if (array_key_exists("UserName",$param) and $param["UserName"] !== null) {
            $this->UserName = $param['UserName'];
        }

        if (array_key_exists("Password",$param) and $param["Password"] !== null) {
            $this->Password = $param['Password'];
        }

        if (array_key_exists("Topic",$param) and $param["Topic"] !== null) {
            $this->Topic = $param['Topic'];
        }

        if (array_key_exists("HeartbeatInterval",$param) and $param["HeartbeatInterval"] !== null) {
            $this->HeartbeatInterval = $param['HeartbeatInterval'];
        }

        if (array_key_exists("ResendEnabled",$param) and $param["ResendEnabled"] !== null) {
            $this->ResendEnabled = $param['ResendEnabled'];
        }

    }
}