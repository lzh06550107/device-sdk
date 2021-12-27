<?php
/**
 * 文件描述
 * Created on 2021/12/27 10:53
 * Create by LZH
 */

namespace JuLongDevice\ParamSetting\Models;

use JuLongDevice\Common\AbstractModel;

// 人脸识别参数
class FaceParameters extends AbstractModel
{
    public $FaceEnabled;
    public $Sensitivity;
    public $CaptureMode;
    /**
     * @var $CaptureModeParam
     */
    public $CaptureModeParam;
    public $MaxFaceSize;
    public $MinFaceSize;
    public $MinTemperatureSize;
    public $SceneMode;
    public $FaceTrackEnabled;
    public $FTPUploadEnabled;
    public $PictureMode;
    public $FacePictureQuality;
    public $ScenePictureQuality;
    public $FaceAttributeEnabled;
    public $LivenessEnabled;
    public $Priority;
    public $Compression;
    public $CompressionSize;
    /**
     * @var array
     */
    public $TimeTable;


    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("FaceEnabled",$param) and $param["FaceEnabled"] !== null) {
            $this->FaceEnabled = $param['FaceEnabled'];
        }

        if (array_key_exists("Sensitivity",$param) and $param["Sensitivity"] !== null) {
            $this->Sensitivity = $param['Sensitivity'];
        }

        if (array_key_exists("CaptureMode",$param) and $param["CaptureMode"] !== null) {
            $this->CaptureMode = $param['CaptureMode'];
        }

        if (array_key_exists("CaptureModeParam",$param) and $param["CaptureModeParam"] !== null) {
            $captureModeParam = new CaptureModeParam();
            $captureModeParam->deserialize($param["CaptureModeParam"]);
            $this->CaptureModeParam = $captureModeParam;
        }

        if (array_key_exists("MaxFaceSize",$param) and $param["MaxFaceSize"] !== null) {
            $this->MaxFaceSize = $param['MaxFaceSize'];
        }

        if (array_key_exists("MinFaceSize",$param) and $param["MinFaceSize"] !== null) {
            $this->MinFaceSize = $param['MinFaceSize'];
        }

        if (array_key_exists("MinTemperatureSize",$param) and $param["MinTemperatureSize"] !== null) {
            $this->MinTemperatureSize = $param['MinTemperatureSize'];
        }

        if (array_key_exists("SceneMode",$param) and $param["SceneMode"] !== null) {
            $this->SceneMode = $param['SceneMode'];
        }

        if (array_key_exists("FaceTrackEnabled",$param) and $param["FaceTrackEnabled"] !== null) {
            $this->FaceTrackEnabled = $param['FaceTrackEnabled'];
        }

        if (array_key_exists("FTPUploadEnabled",$param) and $param["FTPUploadEnabled"] !== null) {
            $this->FTPUploadEnabled = $param['FTPUploadEnabled'];
        }

        if (array_key_exists("PictureMode",$param) and $param["PictureMode"] !== null) {
            $this->PictureMode = $param['PictureMode'];
        }

        if (array_key_exists("FacePictureQuality",$param) and $param["FacePictureQuality"] !== null) {
            $this->FacePictureQuality = $param['FacePictureQuality'];
        }

        if (array_key_exists("ScenePictureQuality",$param) and $param["ScenePictureQuality"] !== null) {
            $this->ScenePictureQuality = $param['ScenePictureQuality'];
        }

        if (array_key_exists("FaceAttributeEnabled",$param) and $param["FaceAttributeEnabled"] !== null) {
            $this->FaceAttributeEnabled = $param['FaceAttributeEnabled'];
        }

        if (array_key_exists("LivenessEnabled",$param) and $param["LivenessEnabled"] !== null) {
            $this->LivenessEnabled = $param['LivenessEnabled'];
        }

        if (array_key_exists("Priority",$param) and $param["Priority"] !== null) {
            $this->Priority = $param['Priority'];
        }

        if (array_key_exists("Compression",$param) and $param["Compression"] !== null) {
            $this->Compression = $param['Compression'];
        }

        if (array_key_exists("CompressionSize",$param) and $param["CompressionSize"] !== null) {
            $this->CompressionSize = $param['CompressionSize'];
        }

        // 布防时间段
        if (array_key_exists("TimeTable",$param) and $param["TimeTable"] !== null) {
            foreach ($param["TimeTable"] as $timeTable) {
                $timeTableObj = new TimeTable();
                $timeTableObj->deserialize($timeTable);
                $this->TimeTable[] = $timeTableObj;
            }
        }

    }
}