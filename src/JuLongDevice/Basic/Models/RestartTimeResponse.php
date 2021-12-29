<?php
/**
 * 文件描述
 * Created on 2021/12/28 11:23
 * Create by LZH
 */

namespace JuLongDevice\Basic\Models;

use JuLongDevice\Common\AbstractResponse;

class RestartTimeResponse extends AbstractResponse
{
    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {

            $restartTime = new RestartTime();
            $restartTime->deserialize($param["Data"]);

            $this->Data = $restartTime;
        }

    }
}