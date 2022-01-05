<?php
/**
 * 文件描述
 * Created on 2022/1/4 9:56
 * Create by LZH
 */

namespace JuLongDevice\NVRManage\Models;

use JuLongDevice\Common\AbstractModel;

class SearchPicture extends AbstractModel
{
    /**
     * @var string 图片标识
     */
    public $PictureID;
    /**
     * @var float 相似度
     */
    public $Similarity;
    /**
     * @var string 开始时间 格式：yyyy-mm-dd hh:mm:ss
     */
    public $StartTime;
    /**
     * @var int 通道号
     */
    public $ChannelNo;
    /**
     * @var int 文件大小（单位: KB）
     */
    public $Size;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("PictureID", $param) and $param["PictureID"] !== null) {
            $this->PictureID = $param['PictureID'];
        }

        if (array_key_exists("Similarity", $param) and $param["Similarity"] !== null) {
            $this->Similarity = $param['Similarity'];
        }

        if (array_key_exists("StartTime", $param) and $param["StartTime"] !== null) {
            $this->StartTime = $param['StartTime'];
        }

        if (array_key_exists("ChannelNo", $param) and $param["ChannelNo"] !== null) {
            $this->ChannelNo = $param['ChannelNo'];
        }

        if (array_key_exists("Size", $param) and $param["Size"] !== null) {
            $this->Size = $param['Size'];
        }
    }
}