<?php
/**
 * 文件描述
 * Created on 2021/12/30 10:44
 * Create by LZH
 */

namespace JuLongDeviceHttp\FaceCompare\Models;

use JuLongDeviceHttp\Common\AbstractResponse;

class HistoryRecordResponse extends AbstractResponse
{

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {

            $this->Data = $param['Data'];
        }

    }
}