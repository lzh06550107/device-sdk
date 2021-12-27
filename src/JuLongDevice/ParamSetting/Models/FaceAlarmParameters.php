<?php
/**
 * 文件描述
 * Created on 2021/12/27 14:31
 * Create by LZH
 */

namespace JuLongDevice\ParamSetting\Models;

use JuLongDevice\Common\AbstractModel;

// 人脸识别报警参数获取
class FaceAlarmParameters extends AbstractModel
{
    /////比对机特有的参数/////////
    public $FaceAlarmEnabled;
    public $BlackListAlarmEnabled;
    public $WhiteListAlarmEnabled;
    public $VIPListAlarmEnabled;
    public $NonWhiteListAlarmEnabled;
    public $IOAlarmEnabled;
    public $IOStateType;
    public $IOSignalType;
    public $IOAlarmTime;
    public $FaceAlarmMode;
    public $FaceAlarmTimes;
    public $PersonsTime;
    public $StrangersTime;
    /**
     * @var TimeTable
     */
    public $TimeTable;
    //////比对机特有的参数/////////

    //////门禁机特有参数/////////
    public $Similarity;
    public $VerifyMode;
    public $MaskCheck;
    public $NoMaskOpenDoor;
    public $TemperatureCheck;
    public $TemperatureThreshold;
    public $TemperatureLevel;
    public $TemperatureMode;
    public $TemperatureAction;
    public $TemperatureUnit;
    public $TemperatureShow;
    /**
     * @var NoTemperatureTimeTable
     */
    public $NoTemperatureTimeTable;
    public $IDCardSimilarity;
    public $WhiteLight;
    public $ScreenMode;
    public $PersonFilter;
    public $IPShow;
    public $TimeShow;
    public $DateFormat;
    public $RecordStorage;
    public $ICModule;
    //////门禁机特有参数/////////

    // 特定设备支持
    public $DeviceRemovaAlarm;

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("FaceAlarmEnabled",$param) and $param["FaceAlarmEnabled"] !== null) {
            $this->FaceAlarmEnabled = $param["FaceAlarmEnabled"];
        }

        if (array_key_exists("BlackListAlarmEnabled",$param) and $param["BlackListAlarmEnabled"] !== null) {
            $this->BlackListAlarmEnabled = $param["BlackListAlarmEnabled"];
        }

        if (array_key_exists("WhiteListAlarmEnabled",$param) and $param["WhiteListAlarmEnabled"] !== null) {
            $this->WhiteListAlarmEnabled = $param["WhiteListAlarmEnabled"];
        }

        if (array_key_exists("VIPListAlarmEnabled",$param) and $param["VIPListAlarmEnabled"] !== null) {
            $this->VIPListAlarmEnabled = $param["VIPListAlarmEnabled"];
        }

        if (array_key_exists("NonWhiteListAlarmEnabled",$param) and $param["NonWhiteListAlarmEnabled"] !== null) {
            $this->NonWhiteListAlarmEnabled = $param["NonWhiteListAlarmEnabled"];
        }

        if (array_key_exists("NonWhiteListAlarmEnabled",$param) and $param["NonWhiteListAlarmEnabled"] !== null) {
            $this->NonWhiteListAlarmEnabled = $param["NonWhiteListAlarmEnabled"];
        }

        if (array_key_exists("IOAlarmEnabled",$param) and $param["IOAlarmEnabled"] !== null) {
            $this->IOAlarmEnabled = $param["IOAlarmEnabled"];
        }

        if (array_key_exists("IOStateType",$param) and $param["IOStateType"] !== null) {
            $this->IOStateType = $param["IOStateType"];
        }

        if (array_key_exists("IOSignalType",$param) and $param["IOSignalType"] !== null) {
            $this->IOSignalType = $param["IOSignalType"];
        }

        if (array_key_exists("IOAlarmTime",$param) and $param["IOAlarmTime"] !== null) {
            $this->IOAlarmTime = $param["IOAlarmTime"];
        }

        if (array_key_exists("FaceAlarmMode",$param) and $param["FaceAlarmMode"] !== null) {
            $this->FaceAlarmMode = $param["FaceAlarmMode"];
        }

        if (array_key_exists("FaceAlarmTimes",$param) and $param["FaceAlarmTimes"] !== null) {
            $this->FaceAlarmTimes = $param["FaceAlarmTimes"];
        }

        if (array_key_exists("PersonsTime",$param) and $param["PersonsTime"] !== null) {
            $this->PersonsTime = $param["PersonsTime"];
        }

        if (array_key_exists("StrangersTime",$param) and $param["StrangersTime"] !== null) {
            $this->StrangersTime = $param["StrangersTime"];
        }

        if (array_key_exists("TimeTable",$param) and $param["TimeTable"] !== null) {
            $timeTables = [];
            foreach ($param['TimeTable'] as $timeTable) {
                $timeTableObj = new TimeTable();
                $timeTableObj->deserialize($timeTable);
                $timeTables[] = $timeTableObj;
            }
            $this->TimeTable = $timeTables;
        }

        if (array_key_exists("Similarity",$param) and $param["Similarity"] !== null) {
            $this->Similarity = $param["Similarity"];
        }

        if (array_key_exists("VerifyMode",$param) and $param["VerifyMode"] !== null) {
            $this->VerifyMode = $param["VerifyMode"];
        }

        if (array_key_exists("MaskCheck",$param) and $param["MaskCheck"] !== null) {
            $this->MaskCheck = $param["MaskCheck"];
        }

        if (array_key_exists("NoMaskOpenDoor",$param) and $param["NoMaskOpenDoor"] !== null) {
            $this->NoMaskOpenDoor = $param["NoMaskOpenDoor"];
        }

        if (array_key_exists("TemperatureCheck",$param) and $param["TemperatureCheck"] !== null) {
            $this->TemperatureCheck = $param["TemperatureCheck"];
        }

        if (array_key_exists("TemperatureThreshold",$param) and $param["TemperatureThreshold"] !== null) {
            $this->TemperatureThreshold = $param["TemperatureThreshold"];
        }

        if (array_key_exists("TemperatureLevel",$param) and $param["TemperatureLevel"] !== null) {
            $this->TemperatureLevel = $param["TemperatureLevel"];
        }

        if (array_key_exists("TemperatureMode",$param) and $param["TemperatureMode"] !== null) {
            $this->TemperatureMode = $param["TemperatureMode"];
        }

        if (array_key_exists("TemperatureAction",$param) and $param["TemperatureAction"] !== null) {
            $this->TemperatureAction = $param["TemperatureAction"];
        }

        if (array_key_exists("TemperatureUnit",$param) and $param["TemperatureUnit"] !== null) {
            $this->TemperatureUnit = $param["TemperatureUnit"];
        }

        if (array_key_exists("TemperatureShow",$param) and $param["TemperatureShow"] !== null) {
            $this->TemperatureShow = $param["TemperatureShow"];
        }

        if (array_key_exists("NoTemperatureTimeTable",$param) and $param["NoTemperatureTimeTable"] !== null) {
            $noTemperatureTimeTables = [];
            foreach ($param['NoTemperatureTimeTable'] as $noTemperatureTimeTable) {
                $noTemperatureTimeTableObj = new NoTemperatureTimeTable();
                $noTemperatureTimeTableObj->deserialize($noTemperatureTimeTable);
                $noTemperatureTimeTables[] = $noTemperatureTimeTableObj;
            }
            $this->NoTemperatureTimeTable = $noTemperatureTimeTables;
        }

        if (array_key_exists("IDCardSimilarity",$param) and $param["IDCardSimilarity"] !== null) {
            $this->IDCardSimilarity = $param["IDCardSimilarity"];
        }

        if (array_key_exists("WhiteLight",$param) and $param["WhiteLight"] !== null) {
            $this->WhiteLight = $param["WhiteLight"];
        }

        if (array_key_exists("ScreenMode",$param) and $param["ScreenMode"] !== null) {
            $this->ScreenMode = $param["ScreenMode"];
        }

        if (array_key_exists("PersonFilter",$param) and $param["PersonFilter"] !== null) {
            $this->PersonFilter = $param["PersonFilter"];
        }

        if (array_key_exists("IPShow",$param) and $param["IPShow"] !== null) {
            $this->IPShow = $param["IPShow"];
        }

        if (array_key_exists("TimeShow",$param) and $param["TimeShow"] !== null) {
            $this->TimeShow = $param["TimeShow"];
        }

        if (array_key_exists("DateFormat",$param) and $param["DateFormat"] !== null) {
            $this->DateFormat = $param["DateFormat"];
        }

        if (array_key_exists("RecordStorage",$param) and $param["RecordStorage"] !== null) {
            $this->RecordStorage = $param["RecordStorage"];
        }

        if (array_key_exists("ICModule",$param) and $param["ICModule"] !== null) {
            $this->ICModule = $param["ICModule"];
        }

        if (array_key_exists("DeviceRemovaAlarm",$param) and $param["DeviceRemovaAlarm"] !== null) {
            $this->DeviceRemovaAlarm = $param["DeviceRemovaAlarm"];
        }

    }

}