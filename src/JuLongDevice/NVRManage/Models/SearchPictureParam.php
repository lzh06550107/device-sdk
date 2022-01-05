<?php
/**
 * 文件描述
 * Created on 2022/1/4 9:57
 * Create by LZH
 */

namespace JuLongDevice\NVRManage\Models;

use JuLongDevice\Common\AbstractModel;

class SearchPictureParam extends AbstractModel
{
    /**
     * @var string 开始时间，格式：yyyy-mm-dd hh:mm:ss
     */
    public $StartTime;
    /**
     * @var string 结束时间，格式：yyyy-mm-dd hh:mm:ss
     */
    public $EndTime;
    /**
     * @var int 列表最大数量5000
     */
    public $PageSize;
    /**
     * @var float 相似度阀值，返回高于此相似度的图片列表
     */
    public $SimilarityThreshold;
    /**
     * @var int 通道号 8421支持多通道搜索 如同时搜索1和3通道 则1+4=5
     */
    public $ChannelNo;
    /**
     * @var int 搜索类型 1: 根据特征值搜索人员图片；2: 根据图片搜索人员图片；
     */
    public $SearchType;
    /**
     * @var string 特征值类型，(SearchType = 1)
     */
    public $FeatureType;
    /**
     * @var string 特征值数据，(SearchType = 1) (base64编码)
     */
    public $FeatureValue;
    /**
     * @var string 人脸图片，(SearchType = 2) (base64编码)
     */
    public $FacePicture;
}