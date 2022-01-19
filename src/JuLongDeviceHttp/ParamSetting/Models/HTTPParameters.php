<?php

namespace JuLongDeviceHttp\ParamSetting\Models;

use JuLongDeviceHttp\Common\AbstractModel;

/**
 * HTTP设置参数
 * Created on 2021/12/27 9:06
 * Create by LZH
 */
class HTTPParameters extends AbstractModel
{

    public $CaptureEnabled;
    public $CaptureAddress;
    public $CaptureType;
    /**
     * @var $CaptureContent
     */
    public $CaptureContent;
    /**
     * @var $PictureData
     */
    public $PictureData;
    public $ResendTimes;
    public $RegisterEnabled;
    public $RegisterAddress;
    public $HeartbeatEnabled;
    public $HeartbeatAddress;
    public $HeartbeatInterval;
    public $EventAddress;
    public $ResultAddress;
    public $MiddleWareEnabled;
    public $MiddleWareAddress;
    public $Mode;
    public $VerifyAddress;
    public $NoticeAddress;
    public $HistoryRecordAddress;
    public $SignCheck;
    public $SendFirst;
    public $OfflineSend;
    public $SendTimeOut;
    public $HTTPVersion;
    public $UploadAfterPlan;

    public function deserialize($param) {

        if ($param === null) {
            return;
        }

        if (array_key_exists("CaptureEnabled",$param) and $param["CaptureEnabled"] !== null) {
            $this->CaptureEnabled = $param['CaptureEnabled'];
        }

        if (array_key_exists("CaptureAddress",$param) and $param["CaptureAddress"] !== null) {
            $this->CaptureAddress = $param['CaptureAddress'];
        }

        if (array_key_exists("CaptureType",$param) and $param["CaptureType"] !== null) {
            $this->CaptureType = $param['CaptureType'];
        }

        if (array_key_exists("CaptureContent",$param) and $param["CaptureContent"] !== null) {
            $captureContent = new CaptureContent();
            $captureContent->deserialize($param["CaptureContent"]);
            $this->CaptureContent = $captureContent;
        }

        if (array_key_exists("PictureData",$param) and $param["PictureData"] !== null) {
            $pictureData = new PictureData();
            $pictureData->deserialize($param["PictureData"]);
            $this->PictureData = $pictureData;
        }

        if (array_key_exists("ResendTimes",$param) and $param["ResendTimes"] !== null) {
            $this->ResendTimes = $param['ResendTimes'];
        }

        if (array_key_exists("RegisterEnabled",$param) and $param["RegisterEnabled"] !== null) {
            $this->RegisterEnabled = $param['RegisterEnabled'];
        }

        if (array_key_exists("RegisterAddress",$param) and $param["RegisterAddress"] !== null) {
            $this->RegisterAddress = $param['RegisterAddress'];
        }

        if (array_key_exists("HeartbeatEnabled",$param) and $param["HeartbeatEnabled"] !== null) {
            $this->HeartbeatEnabled = $param['HeartbeatEnabled'];
        }

        if (array_key_exists("HeartbeatAddress",$param) and $param["HeartbeatAddress"] !== null) {
            $this->HeartbeatAddress = $param['HeartbeatAddress'];
        }

        if (array_key_exists("HeartbeatInterval",$param) and $param["HeartbeatInterval"] !== null) {
            $this->HeartbeatInterval = $param['HeartbeatInterval'];
        }

        if (array_key_exists("EventAddress",$param) and $param["EventAddress"] !== null) {
            $this->EventAddress = $param['EventAddress'];
        }

        if (array_key_exists("ResultAddress",$param) and $param["ResultAddress"] !== null) {
            $this->ResultAddress = $param['ResultAddress'];
        }

        if (array_key_exists("MiddleWareEnabled",$param) and $param["MiddleWareEnabled"] !== null) {
            $this->MiddleWareEnabled = $param['MiddleWareEnabled'];
        }

        if (array_key_exists("MiddleWareAddress",$param) and $param["MiddleWareAddress"] !== null) {
            $this->MiddleWareAddress = $param['MiddleWareAddress'];
        }

        if (array_key_exists("Mode",$param) and $param["Mode"] !== null) {
            $this->Mode = $param['Mode'];
        }

        if (array_key_exists("VerifyAddress",$param) and $param["VerifyAddress"] !== null) {
            $this->VerifyAddress = $param['VerifyAddress'];
        }

        if (array_key_exists("NoticeAddress",$param) and $param["NoticeAddress"] !== null) {
            $this->NoticeAddress = $param['NoticeAddress'];
        }

        if (array_key_exists("HistoryRecordAddress",$param) and $param["HistoryRecordAddress"] !== null) {
            $this->HistoryRecordAddress = $param['HistoryRecordAddress'];
        }

        if (array_key_exists("SignCheck",$param) and $param["SignCheck"] !== null) {
            $this->SignCheck = $param['SignCheck'];
        }

        if (array_key_exists("SendFirst",$param) and $param["SendFirst"] !== null) {
            $this->SendFirst = $param['SendFirst'];
        }

        if (array_key_exists("OfflineSend",$param) and $param["OfflineSend"] !== null) {
            $this->OfflineSend = $param['OfflineSend'];
        }

        if (array_key_exists("SendTimeOut",$param) and $param["SendTimeOut"] !== null) {
            $this->SendTimeOut = $param['SendTimeOut'];
        }

        if (array_key_exists("HTTPVersion",$param) and $param["HTTPVersion"] !== null) {
            $this->HTTPVersion = $param['HTTPVersion'];
        }

        if (array_key_exists("UploadAfterPlan",$param) and $param["UploadAfterPlan"] !== null) {
            $this->UploadAfterPlan = $param['UploadAfterPlan'];
        }

    }

}