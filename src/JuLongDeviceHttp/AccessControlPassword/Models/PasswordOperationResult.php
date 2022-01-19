<?php
/**
 * 文件描述
 * Created on 2022/1/4 11:49
 * Create by LZH
 */

namespace JuLongDeviceHttp\AccessControlPassword\Models;

use JuLongDeviceHttp\Common\AbstractModel;

class PasswordOperationResult extends AbstractModel
{
    /**
     * @var string 密码ID
     */
    public $PasswordId;
    /**
     * @var int 操作结果
     */
    public $ResultCode;
    /**
     * @var string 结果描述
     */
    public $ResultMessage;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("PasswordId",$param) and $param["PasswordId"] !== null) {
            $this->PasswordId = $param['PasswordId'];
        }

        if (array_key_exists("ResultCode",$param) and $param["ResultCode"] !== null) {
            $this->ResultCode = $param['ResultCode'];
        }

        if (array_key_exists("ResultMessage",$param) and $param["ResultMessage"] !== null) {
            $this->ResultMessage = $param["ResultMessage"];
        }
    }
}