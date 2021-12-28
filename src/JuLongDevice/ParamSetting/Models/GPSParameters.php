<?php
/**
 * 文件描述
 * Created on 2021/12/28 9:48
 * Create by LZH
 */

namespace JuLongDevice\ParamSetting\Models;

use JuLongDevice\Common\AbstractModel;

// GPS信息参数
class GPSParameters extends AbstractModel
{
    public $GPSEnabled;
    public $GPSInfoInterval;
    public $Longitude;
    public $Latitude;
    public $Altitude;
    public $Time;
    public $Date;
    public $Speed;
    public $CNR;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("GPSEnabled",$param) and $param["GPSEnabled"] !== null) {
            $this->GPSEnabled = $param['GPSEnabled'];
        }

        if (array_key_exists("GPSInfoInterval",$param) and $param["GPSInfoInterval"] !== null) {
            $this->GPSInfoInterval = $param['GPSInfoInterval'];
        }

        if (array_key_exists("Longitude",$param) and $param["Longitude"] !== null) {
            $this->Longitude = $param['Longitude'];
        }

        if (array_key_exists("Latitude",$param) and $param["Latitude"] !== null) {
            $this->Latitude = $param['Latitude'];
        }

        if (array_key_exists("Altitude",$param) and $param["Altitude"] !== null) {
            $this->Altitude = $param['Altitude'];
        }

        if (array_key_exists("Time",$param) and $param["Time"] !== null) {
            $this->Time = $param['Time'];
        }

        if (array_key_exists("Date",$param) and $param["Date"] !== null) {
            $this->Date = $param['Date'];
        }

        if (array_key_exists("Speed",$param) and $param["Speed"] !== null) {
            $this->Speed = $param['Speed'];
        }

        if (array_key_exists("CNR",$param) and $param["CNR"] !== null) {
            $this->CNR = $param['CNR'];
        }

    }
}