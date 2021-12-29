<?php
/**
 * 文件描述
 * Created on 2021/12/28 15:05
 * Create by LZH
 */

namespace JuLongDevice\FaceManage\Models;

use JuLongDevice\Common\AbstractResponse;

class PersonListResponse extends AbstractResponse
{
    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {

            $respClass = "JuLongDevice\\FaceManage\\Models"."\\".ucfirst($param["Data"]["Action"])."Response";
            $obj = new $respClass();
            $obj->deserialize($param["Data"]);
            $this->Data = $obj;
        }

    }
}