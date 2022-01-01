<?php
/**
 * 文件描述
 * Created on 2021/12/31 10:25
 * Create by LZH
 */

namespace JuLongDevice\AccessStrategy\Models;

use JuLongDevice\Common\AbstractModel;

/**
 * 通行策略信息
 * Created on 2021/12/31 10:26
 * Create by LZH
 */
class StrategyInfo extends AbstractModel
{
    /**
     * @var int 策略ID（唯一标识）
     */
    public $StrategyId;
    /**
     * @var string 通行策略名称
     */
    public $StrategyName;
    /**
     * @var int 通行次数限制
     * 0：不限制
     * 1：限制通行次数
     */
    public $AccessNumLimit;
    /**
     * @var int 通行次数
     */
    public $AllowAccessNum;
    /**
     * @var string 通行策略生效时间，格式：yyyy-mm-dd hh:mm:ss
     */
    public $StartTime;
    /**
     * @var string 通行策略失效时间，格式：yyyy-mm-dd hh:mm:ss
     */
    public $EndTime;
    /**
     * @var TimePeriod[] 周一通行策略
     */
    public $Monday;
    /**
     * @var TimePeriod[] 周二通行策略
     */
    public $Tuesday;
    /**
     * @var TimePeriod[] 周三通行策略
     */
    public $Wednesday;
    /**
     * @var TimePeriod[] 周四通行策略
     */
    public $Thursday;
    /**
     * @var TimePeriod[] 周五通行策略
     */
    public $Friday;
    /**
     * @var TimePeriod[] 周六通行策略
     */
    public $Saturday;
    /**
     * @var TimePeriod[] 周日通行策略
     */
    public $Sunday;
    /**
     * @var HolidayInfo[] 节假日策略
     */
    public $HolidayInfo;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("StrategyId",$param) and $param["StrategyId"] !== null) {
            $this->StrategyId = $param['StrategyId'];
        }

        if (array_key_exists("StrategyName",$param) and $param["StrategyName"] !== null) {
            $this->StrategyName = $param['StrategyName'];
        }

        if (array_key_exists("AccessNumLimit",$param) and $param["AccessNumLimit"] !== null) {
            $this->AccessNumLimit = $param['AccessNumLimit'];
        }

        if (array_key_exists("AllowAccessNum",$param) and $param["AllowAccessNum"] !== null) {
            $this->AllowAccessNum = $param['AllowAccessNum'];
        }

        if (array_key_exists("StartTime",$param) and $param["StartTime"] !== null) {
            $this->StartTime = $param['StartTime'];
        }

        if (array_key_exists("EndTime",$param) and $param["EndTime"] !== null) {
            $this->EndTime = $param['EndTime'];
        }

        if (array_key_exists("Monday",$param) and $param["Monday"] !== null) {
            $mondayList = [];
            foreach ($param['Monday'] as $monday) {
                $mondayObj = new TimePeriod();
                $mondayObj->deserialize($monday);
                $mondayList[] = $mondayObj;
            }
            $this->Monday = $mondayList;
        }

        if (array_key_exists("Tuesday",$param) and $param["Tuesday"] !== null) {
            $tuesdayList = [];
            foreach ($param['Tuesday'] as $tuesday) {
                $tuesdayObj = new TimePeriod();
                $tuesdayObj->deserialize($tuesday);
                $tuesdayList[] = $tuesdayObj;
            }
            $this->Tuesday = $tuesdayList;
        }

        if (array_key_exists("Wednesday",$param) and $param["Wednesday"] !== null) {
            $wednesdayList = [];
            foreach ($param['Wednesday'] as $wednesday) {
                $wednesdayObj = new TimePeriod();
                $wednesdayObj->deserialize($wednesday);
                $wednesdayList[] = $wednesdayObj;
            }
            $this->Wednesday = $wednesdayList;
        }

        if (array_key_exists("Thursday",$param) and $param["Thursday"] !== null) {
            $thursdayList = [];
            foreach ($param['Thursday'] as $thursday) {
                $thursdayObj = new TimePeriod();
                $thursdayObj->deserialize($thursday);
                $thursdayList[] = $thursdayObj;
            }
            $this->Thursday = $thursdayList;
        }

        if (array_key_exists("Friday",$param) and $param["Friday"] !== null) {
            $fridayList = [];
            foreach ($param['Friday'] as $friday) {
                $fridayObj = new TimePeriod();
                $fridayObj->deserialize($friday);
                $fridayList[] = $fridayObj;
            }
            $this->Friday = $fridayList;
        }

        if (array_key_exists("Saturday",$param) and $param["Saturday"] !== null) {
            $saturdayList = [];
            foreach ($param['Saturday'] as $saturday) {
                $saturdayObj = new TimePeriod();
                $saturdayObj->deserialize($saturday);
                $saturdayList[] = $saturdayObj;
            }
            $this->Saturday = $saturdayList;
        }

        if (array_key_exists("Sunday",$param) and $param["Sunday"] !== null) {
            $sundayList = [];
            foreach ($param['Sunday'] as $sunday) {
                $sundayObj = new TimePeriod();
                $sundayObj->deserialize($sunday);
                $sundayList[] = $sundayObj;
            }
            $this->Sunday = $sundayList;
        }

        if (array_key_exists("HolidayInfo",$param) and $param["HolidayInfo"] !== null) {
            $holidayInfoList = [];
            foreach ($param['HolidayInfo'] as $holidayInfo) {
                $holidayInfoObj = new HolidayInfo();
                $holidayInfoObj->deserialize($holidayInfo);
                $holidayInfoList[] = $holidayInfoObj;
            }
            $this->HolidayInfo = $holidayInfoList;
        }

    }
}