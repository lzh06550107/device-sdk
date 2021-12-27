<?php
/**
 * 文件描述
 * Created on 2021/12/27 9:46
 * Create by LZH
 */

namespace JuLongDevice\ParamSetting\Models;

use JuLongDevice\Common\AbstractModel;

// 推送抓拍信息时是否包含相应的图片数据
class PictureData extends AbstractModel
{
    public $FacePicture;
    public $BodyPicture;
    public $BackgroundPicture;
    public $PersonPhoto;
    public $IDCardPhoto;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("FacePicture",$param) and $param["FacePicture"] !== null) {
            $this->FacePicture = $param['FacePicture'];
        }

        if (array_key_exists("BodyPicture",$param) and $param["BodyPicture"] !== null) {
            $this->BodyPicture = $param['BodyPicture'];
        }

        if (array_key_exists("BackgroundPicture",$param) and $param["BackgroundPicture"] !== null) {
            $this->BackgroundPicture = $param['BackgroundPicture'];
        }

        if (array_key_exists("PersonPhoto",$param) and $param["PersonPhoto"] !== null) {
            $this->PersonPhoto = $param['PersonPhoto'];
        }

        if (array_key_exists("IDCardPhoto",$param) and $param["IDCardPhoto"] !== null) {
            $this->IDCardPhoto = $param['IDCardPhoto'];
        }


    }
}