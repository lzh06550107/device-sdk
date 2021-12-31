<?php
/**
 * 文件描述
 * Created on 2021/12/31 9:33
 * Create by LZH
 */

namespace JuLongDevice\FaceCompare\Models;

use JuLongDevice\Common\AbstractModel;

class DetectFace extends AbstractModel
{
    /**
     * @var string 人脸图片数据（base64）
     */
    public $FacePicture;
}