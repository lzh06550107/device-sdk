<?php
/**
 * 文件描述
 * Created on 2021/12/28 9:32
 * Create by LZH
 */

namespace JuLongDeviceHttp\ParamSetting\Models;

use JuLongDeviceHttp\Common\AbstractModel;

// 用户名密码
class UserPassword extends AbstractModel
{
    public $VerificationMode;
    public $EncryptionMode;
    public $OldUserName;
    public $OldPassword;
    public $NewUserName;
    public $NewPassword;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("VerificationMode",$param) and $param["VerificationMode"] !== null) {
            $this->VerificationMode = $param['VerificationMode'];
        }

        if (array_key_exists("EncryptionMode",$param) and $param["EncryptionMode"] !== null) {
            $this->EncryptionMode = $param['EncryptionMode'];
        }

        if (array_key_exists("OldUserName",$param) and $param["OldUserName"] !== null) {
            $this->OldUserName = $param['OldUserName'];
        }

        if (array_key_exists("OldPassword",$param) and $param["OldPassword"] !== null) {
            $this->OldPassword = $param['OldPassword'];
        }

        if (array_key_exists("NewUserName",$param) and $param["NewUserName"] !== null) {
            $this->NewUserName = $param['NewUserName'];
        }

        if (array_key_exists("NewPassword",$param) and $param["NewPassword"] !== null) {
            $this->NewPassword = $param['NewPassword'];
        }

    }
}