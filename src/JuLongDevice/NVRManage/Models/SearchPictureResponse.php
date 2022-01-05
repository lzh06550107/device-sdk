<?php
/**
 * 文件描述
 * Created on 2022/1/4 9:55
 * Create by LZH
 */

namespace JuLongDevice\NVRManage\Models;

use JuLongDevice\Common\AbstractResponse;

class SearchPictureResponse extends AbstractResponse
{
    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {

            $searchPictureResult = new SearchPictureResult();
            $searchPictureResult->deserialize($param["Data"]);

            $this->Data = $searchPictureResult;
        }

    }
}