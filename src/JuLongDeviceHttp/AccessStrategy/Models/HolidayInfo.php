<?php
/**
 * 文件描述
 * Created on 2021/12/31 10:32
 * Create by LZH
 */

namespace JuLongDeviceHttp\AccessStrategy\Models;

class HolidayInfo
{
    /**
     * @var string 节假日开始时间，格式：yyyy-mm-dd hh:mm:ss
     */
    public $HolidayStartTime;
    /**
     * @var string 节假日结束时间，格式：yyyy-mm-dd hh:mm:ss
     */
    public $HolidayEndTime;
    /**
     * @var TimePeriod[] 节假日时间段
     */
    public $HolidayPeriod;

    /**
     * @param string $HolidayStartTime
     * @param string $HolidayEndTime
     * @param array $HolidayPeriod
     */
    public function __construct(string $HolidayStartTime = '', string $HolidayEndTime = '', array $HolidayPeriod = [])
    {
        $this->HolidayStartTime = $HolidayStartTime;
        $this->HolidayEndTime = $HolidayEndTime;
        $this->HolidayPeriod = $HolidayPeriod;
    }

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("HolidayStartTime",$param) and $param["HolidayStartTime"] !== null) {
            $this->HolidayStartTime = $param['HolidayStartTime'];
        }

        if (array_key_exists("HolidayEndTime",$param) and $param["HolidayEndTime"] !== null) {
            $this->HolidayEndTime = $param['HolidayEndTime'];
        }

        if (array_key_exists("HolidayPeriod",$param) and $param["HolidayPeriod"] !== null) {
            $timePeriodList = [];
            foreach ($param['HolidayPeriod'] as $holidayPeriod) {
                $timePeriod = new TimePeriod();
                $timePeriod->deserialize($holidayPeriod);
                $timePeriodList[] = $timePeriod;
            }
            $this->HolidayPeriod = $timePeriodList;
        }
    }

}