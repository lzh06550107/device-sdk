<?php
/**
 * 文件描述
 * Created on 2021/12/27 18:06
 * Create by LZH
 */

namespace JuLongDeviceHttp\ParamSetting\Models;

use JuLongDeviceHttp\Common\AbstractModel;

// 时间参数获取（NTP）
class TimeParameters extends AbstractModel
{
    public $LocalTime;
    public $TimeZone;
    public $NTPEnabled;
    public $NTPServer;
    public $NTPPort;
    public $NTPInterval;

    public function deserialize($param) {

        if ($param === null) {
            return;
        }

        if (array_key_exists("LocalTime",$param) and $param["LocalTime"] !== null) {
            $this->LocalTime = $param["LocalTime"];
        }

        if (array_key_exists("TimeZone",$param) and $param["TimeZone"] !== null) {
            $this->TimeZone = $param["TimeZone"];
        }

        if (array_key_exists("NTPEnabled",$param) and $param["NTPEnabled"] !== null) {
            $this->NTPEnabled = $param["NTPEnabled"];
        }

        if (array_key_exists("NTPServer",$param) and $param["NTPServer"] !== null) {
            $this->NTPServer = $param["NTPServer"];
        }

        if (array_key_exists("NTPPort",$param) and $param["NTPPort"] !== null) {
            $this->NTPPort = $param["NTPPort"];
        }

        if (array_key_exists("NTPInterval",$param) and $param["NTPInterval"] !== null) {
            $this->NTPInterval = $param["NTPInterval"];
        }

    }
}