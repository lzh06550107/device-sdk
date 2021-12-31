<?php
/**
 * 文件描述
 * Created on 2021/12/30 18:40
 * Create by LZH
 */

namespace JuLongDevice\FaceCompare\Models;

use JuLongDevice\Common\AbstractResponse;

class FaceSearchResponse extends AbstractResponse
{
    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {
            $faceSearchResult = new FaceSearchResult();
            $faceSearchResult->deserialize($param['Data']);
            $this->Data = $faceSearchResult;
        }

    }
}