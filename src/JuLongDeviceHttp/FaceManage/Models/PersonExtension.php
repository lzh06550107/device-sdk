<?php
/**
 * 文件描述
 * Created on 2021/12/29 15:43
 * Create by LZH
 */

namespace JuLongDeviceHttp\FaceManage\Models;

use JuLongDeviceHttp\Common\AbstractModel;

// 扩展人员信息
class PersonExtension extends AbstractModel
{

    public $PersonCode1;
    public $PersonCode2;
    public $PersonCode3;
    public $PersonReserveName;
    public $PersonParam1;
    public $PersonParam2;
    public $PersonParam3;
    public $PersonParam4;
    public $PersonParam5;
    public $PersonData1;
    public $PersonData2;
    public $PersonData3;
    public $PersonData4;
    public $PersonData5;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("PersonCode1", $param) and $param["PersonCode1"] !== null) {
            $this->PersonCode1 = $param['PersonCode1'];
        }

        if (array_key_exists("PersonCode2", $param) and $param["PersonCode2"] !== null) {
            $this->PersonCode2 = $param['PersonCode2'];
        }

        if (array_key_exists("PersonCode3", $param) and $param["PersonCode3"] !== null) {
            $this->PersonCode3 = $param['PersonCode3'];
        }

        if (array_key_exists("PersonReserveName", $param) and $param["PersonReserveName"] !== null) {
            $this->PersonReserveName = $param['PersonReserveName'];
        }

        if (array_key_exists("PersonParam1", $param) and $param["PersonParam1"] !== null) {
            $this->PersonParam1 = $param['PersonParam1'];
        }

        if (array_key_exists("PersonParam2", $param) and $param["PersonParam2"] !== null) {
            $this->PersonParam2 = $param['PersonParam2'];
        }

        if (array_key_exists("PersonParam3", $param) and $param["PersonParam3"] !== null) {
            $this->PersonParam3 = $param['PersonParam3'];
        }

        if (array_key_exists("PersonParam4", $param) and $param["PersonParam4"] !== null) {
            $this->PersonParam4 = $param['PersonParam4'];
        }

        if (array_key_exists("PersonParam5", $param) and $param["PersonParam5"] !== null) {
            $this->PersonParam5 = $param['PersonParam5'];
        }

        if (array_key_exists("PersonData1", $param) and $param["PersonData1"] !== null) {
            $this->PersonData1 = $param['PersonData1'];
        }

        if (array_key_exists("PersonData2", $param) and $param["PersonData2"] !== null) {
            $this->PersonData2 = $param['PersonData2'];
        }

        if (array_key_exists("PersonData3", $param) and $param["PersonData3"] !== null) {
            $this->PersonData3 = $param['PersonData3'];
        }

        if (array_key_exists("PersonData4", $param) and $param["PersonData4"] !== null) {
            $this->PersonData4 = $param['PersonData4'];
        }

        if (array_key_exists("PersonData5", $param) and $param["PersonData5"] !== null) {
            $this->PersonData5 = $param['PersonData5'];
        }

    }

}