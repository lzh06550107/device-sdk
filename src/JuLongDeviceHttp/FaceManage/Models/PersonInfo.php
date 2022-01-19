<?php
/**
 * 文件描述
 * Created on 2021/12/28 14:58
 * Create by LZH
 */

namespace JuLongDeviceHttp\FaceManage\Models;

use JuLongDeviceHttp\Common\AbstractModel;
use JuLongDeviceHttp\FaceManage\PersonIdentity;

/**
 * 人员信息
 * Created on 2021/12/28 14:58
 * Create by LZH
 */
class PersonInfo extends AbstractModel
{
    /**
     * @var string 人员ID
     */
    public $PersonId;
    /**
     * @var string 人员姓名
     */
    public $PersonName;
    /**
     * @var int 性别 1：男  2：女  0：未知
     */
    public $Sex;
    /**
     * @var string 身份证编号
     */
    public $IDCard;
    /**
     * @var string 民族
     */
    public $Nation;
    /**
     * @var string 生日
     */
    public $Birthday;
    /**
     * @var string 电话号码
     */
    public $Phone;
    /**
     * @var string 住址
     */
    public $Address;
    /**
     * @var string 人员添加时间
     */
    public $SaveTime;
    /**
     * @var int 人员有效时间限制 0：永久有效；1：周期有效
     */
    public $LimitTime;
    /**
     * @var string 人员有效开始时间 格式:yyyy-mm-dd hh:mm:ss
     */
    public $StartTime;
    /**
     * @var string 人员有效结束时间 格式:yyyy-mm-dd hh:mm:ss
     */
    public $EndTime;
    /**
     * @var PersonIdentity 人员身份，用于名单分类
     */
    public $PersonIdentity;
    /**
     * @var array 关联通行策略
     */
    public $StrategyTable;
    /**
     * @var string 人员标签
     */
    public $Label;
    /**
     * @var string 绑定的IC卡号
     */
    public $ICCardNo;
    public $ICCardNoList;
    /**
     * @var PersonExtension 人员扩展
     */
    public $PersonExtension;
    /**
     * @var string 人员照片（base64编码）
     */
    public $PersonPhoto;
    /**
     * @var string 人员特征值数据(base64编码)
     */
    public $FeatureValue;
    /**
     * @var StudentsInfo 分班播报学生信息列表
     */
    public $StudentsInfo;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("PersonId",$param) and $param["PersonId"] !== null) {
            $this->PersonId = $param['PersonId'];
        }

        if (array_key_exists("PersonName",$param) and $param["PersonName"] !== null) {
            $this->PersonName = $param['PersonName'];
        }

        if (array_key_exists("Sex",$param) and $param["Sex"] !== null) {
            $this->Sex = $param['Sex'];
        }

        if (array_key_exists("IDCard",$param) and $param["IDCard"] !== null) {
            $this->IDCard = $param['IDCard'];
        }

        if (array_key_exists("Nation",$param) and $param["Nation"] !== null) {
            $this->Nation = $param['Nation'];
        }

        if (array_key_exists("Birthday",$param) and $param["Birthday"] !== null) {
            $this->Birthday = $param['Birthday'];
        }

        if (array_key_exists("Phone",$param) and $param["Phone"] !== null) {
            $this->Phone = $param['Phone'];
        }

        if (array_key_exists("Address",$param) and $param["Address"] !== null) {
            $this->Address = $param['Address'];
        }

        if (array_key_exists("SaveTime",$param) and $param["SaveTime"] !== null) {
            $this->SaveTime = $param['SaveTime'];
        }

        if (array_key_exists("LimitTime",$param) and $param["LimitTime"] !== null) {
            $this->LimitTime = $param['LimitTime'];
        }

        if (array_key_exists("StartTime",$param) and $param["StartTime"] !== null) {
            $this->StartTime = $param['StartTime'];
        }

        if (array_key_exists("EndTime",$param) and $param["EndTime"] !== null) {
            $this->EndTime = $param['EndTime'];
        }

        if (array_key_exists("PersonIdentity",$param) and $param["PersonIdentity"] !== null) {
            $this->PersonIdentity = $param['PersonIdentity'];
        }

        if (array_key_exists("StrategyTable",$param) and $param["StrategyTable"] !== null) {
            $this->StrategyTable = $param['StrategyTable'];
        }

        if (array_key_exists("IdentityAttribute",$param) and $param["IdentityAttribute"] !== null) {
            $this->IdentityAttribute = $param['IdentityAttribute'];
        }

        if (array_key_exists("Label",$param) and $param["Label"] !== null) {
            $this->Label = $param['Label'];
        }

        if (array_key_exists("ICCardNo",$param) and $param["ICCardNo"] !== null) {
            $this->ICCardNo = $param['ICCardNo'];
        }

        if (array_key_exists("ICCardNoList",$param) and $param["ICCardNoList"] !== null) {
            $this->ICCardNoList = $param['ICCardNoList'];
        }

        if (array_key_exists("PersonExtension",$param) and $param["PersonExtension"] !== null) {
            $personExtension = new PersonExtension();
            $personExtension->deserialize($param['PersonExtension']);
            $this->PersonExtension = $personExtension;
        }

        if (array_key_exists("PersonPhoto",$param) and $param["PersonPhoto"] !== null) {
            $this->PersonPhoto = $param['PersonPhoto'];
        }

        if (array_key_exists("FeatureValue",$param) and $param["FeatureValue"] !== null) {
            $this->FeatureValue = $param['FeatureValue'];
        }

        if (array_key_exists("StudentsInfo",$param) and $param["StudentsInfo"] !== null) {
            $studentsInfo = new StudentsInfo();
            $studentsInfo->deserialize($param['StudentsInfo']);
            $this->StudentsInfo = $studentsInfo;
        }

    }
}