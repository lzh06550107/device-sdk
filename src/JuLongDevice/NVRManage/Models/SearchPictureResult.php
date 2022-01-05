<?php
/**
 * 文件描述
 * Created on 2022/1/4 9:57
 * Create by LZH
 */

namespace JuLongDevice\NVRManage\Models;

use JuLongDevice\Common\AbstractModel;

class SearchPictureResult extends AbstractModel
{
    /**
     * @var int 列表最大数量5000
     */
    public $PageSize;
    /**
     * @var float 相似度阀值，返回高于此相似度的图片列表
     */
    public $SimilarityThreshold;
    /**
     * @var int 当前列表返回数量
     */
    public $Count;
    /**
     * @var SearchPicture[] 获取到的图片列表
     */
    public $List;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("PageSize", $param) and $param["PageSize"] !== null) {
            $this->PageSize = $param['PageSize'];
        }

        if (array_key_exists("SimilarityThreshold", $param) and $param["SimilarityThreshold"] !== null) {
            $this->SimilarityThreshold = $param['SimilarityThreshold'];
        }

        if (array_key_exists("Count", $param) and $param["Count"] !== null) {
            $this->Count = $param['Count'];
        }

        if (array_key_exists("List", $param) and $param["List"] !== null) {
            $list_result = [];
            foreach ($param['List'] as $searchVideo) {
                $searchVideoObj = new SearchPicture();
                $searchVideoObj->deserialize($searchVideo);
                $list_result[] = $searchVideoObj;
            }
            $this->List = $list_result;
        }
    }
}