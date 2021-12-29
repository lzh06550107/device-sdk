<?php
/**
 * 文件描述
 * Created on 2021/12/28 14:58
 * Create by LZH
 */

namespace JuLongDevice\FaceManage\Models;

use JuLongDevice\Common\AbstractModel;
use JuLongDevice\FaceManage\PersonIdentity;

/**
 * 人员
 * Created on 2021/12/28 14:58
 * Create by LZH
 */
class PersonInfo extends AbstractModel
{
    public $PersonId;
    public $PersonName;
    public $Sex;
    public $IDCard;
    public $Nation;
    public $Birthday;
    public $Phone;
    public $Address;
    public $SaveTime;
    public $LimitTime;
    public $StartTime;
    public $EndTime;
    public $PersonIdentity;
    public $IdentityAttribute;
    public $Label;
    public $ICCardNo;
    public $ICCardNoList;
    public $PersonExtension;
    public $PersonPhoto;

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
            $this->PersonExtension = $param['PersonExtension'];
        }

        if (array_key_exists("PersonPhoto",$param) and $param["PersonPhoto"] !== null) {
            $this->PersonPhoto = $param['PersonPhoto'];
        }

    }
}