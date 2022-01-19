<?php
/**
 * 文件描述
 * Created on 2021/12/31 15:36
 * Create by LZH
 */

namespace JuLongDeviceHttp\AccessStrategy\Models;

use JuLongDeviceHttp\Common\AbstractModel;

class IdentifyStrategys extends AbstractModel
{
    public $PersonIdentity;
    public $IdentityName;
    public $StrategyTable;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("PersonIdentity",$param) and $param["PersonIdentity"] !== null) {
            $this->PersonIdentity = $param['PersonIdentity'];
        }

        if (array_key_exists("IdentityName",$param) and $param["IdentityName"] !== null) {
            $this->IdentityName = $param['IdentityName'];
        }

        if (array_key_exists("StrategyTable",$param) and $param["StrategyTable"] !== null) {
            $this->StrategyTable = $param['StrategyTable'];
        }
    }
}