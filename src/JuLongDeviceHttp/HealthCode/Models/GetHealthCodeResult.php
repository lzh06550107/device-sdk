<?php
/**
 * 文件描述
 * Created on 2022/1/4 14:00
 * Create by LZH
 */

namespace JuLongDeviceHttp\HealthCode\Models;

use JuLongDeviceHttp\Common\AbstractModel;

class GetHealthCodeResult extends AbstractModel
{
    /**
     * @var int 健康码类型
     */
    public $HealthCodeType;
    /**
     * @var string 行程更新时间
     */
    public $TripUpdateTime;
    /**
     * @var string 行程地点
     */
    public $TripPath;
    /**
     * @var NATInfo 核酸检测信息
     */
    public $NATInfo;

    public function deserialize($param) {

        if ($param === null) {
            return;
        }

        if (array_key_exists("HealthCodeType",$param) and $param["HealthCodeType"] !== null) {
            $this->HealthCodeType = $param['HealthCodeType'];
        }

        if (array_key_exists("TripUpdateTime",$param) and $param["TripUpdateTime"] !== null) {
            $this->TripUpdateTime = $param['TripUpdateTime'];
        }

        if (array_key_exists("TripPath",$param) and $param["TripPath"] !== null) {
            $this->TripPath = $param['TripPath'];
        }

        if (array_key_exists("NATInfo",$param) and $param["NATInfo"] !== null) {
            $natInfo = new NATInfo();
            $natInfo->deserialize($param['TripPath']);
            $this->NATInfo = $natInfo;
        }


    }
}