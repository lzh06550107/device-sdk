<?php
/**
 * 文件描述
 * Created on 2021/12/31 9:19
 * Create by LZH
 */

namespace JuLongDeviceHttp\FaceCompare\Models;

use JuLongDeviceHttp\Common\AbstractModel;

class FaceSimilarity extends AbstractModel
{
    /**
     * @var int 比较方式
     * 0：图片（默认）
     * 1：特征值（未支持）
     */
    public $Type;
    /**
     * @var string 人脸数据1（base64）
     */
    public $FaceData1;
    /**
     * @var string 人脸数据2（base64）
     */
    public $FaceData2;
}