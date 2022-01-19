<?php
/**
 * 文件描述
 * Created on 2021/12/31 10:31
 * Create by LZH
 */

namespace JuLongDeviceHttp\AccessStrategy\Models;


use JuLongDeviceHttp\Common\AbstractModel;

class TimePeriod extends AbstractModel
{
    /**
     * @var string 策略时间段开始时间，格式：hh:mm:ss
     */
    public $BeginTime;
    /**
     * @var string 策略时间段结束时间，格式：hh:mm:ss
     */
    public $EndTime;

    /**
     * @param string $BeginTime
     * @param string $EndTime
     */
    public function __construct(string $BeginTime = '', string $EndTime = '')
    {
        $this->BeginTime = $BeginTime;
        $this->EndTime = $EndTime;
    }

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("BeginTime",$param) and $param["BeginTime"] !== null) {
            $this->BeginTime = $param['BeginTime'];
        }

        if (array_key_exists("EndTime",$param) and $param["EndTime"] !== null) {
            $this->EndTime = $param['EndTime'];
        }
    }

}