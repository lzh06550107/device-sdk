<?php
/**
 * 文件描述
 * Created on 2021/12/30 18:41
 * Create by LZH
 */

namespace JuLongDevice\FaceCompare\Models;

use JuLongDevice\Common\AbstractModel;

class FaceSearch extends AbstractModel
{
    /**
     * @var int 名单类型
     * 0：所有名单
     * 1：黑名单
     * 2：白名单
     * 3：VIP名单
     */
    public $PersonType;
    /**
     * @var int 搜索方式
     * 0：图片（默认）
     * 1：特征值
     */
    public $SearchType;
    /**
     * @var int 相似度阀值
     */
    public $Similarity;
    /**
     * @var string 人脸图片数据
     */
    public $FacePicture;
    /**
     * @var string 人脸特征值数据
     */
    public $FeatureValue;
    /**
     * @var int 是否获取名单库人员图片数据
     * 0：不返回图片
     * 1：返回图片
     */
    public $GetPhoto;
}