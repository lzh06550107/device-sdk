<?php
/**
 * 文件描述
 * Created on 2022/1/4 13:51
 * Create by LZH
 */

namespace JuLongDevice\HealthCode\Models;

use JuLongDevice\Common\AbstractResponse;

class GetHealthCodeResponse extends AbstractResponse
{
    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {

            $getHealthCodeResult = new GetHealthCodeResult();
            $getHealthCodeResult->deserialize($param["Data"]);

            $this->Data = $getHealthCodeResult;
        }


    }
}