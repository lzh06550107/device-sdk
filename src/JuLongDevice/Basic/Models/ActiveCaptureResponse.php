<?php
/**
 * 文件描述
 * Created on 2021/12/28 11:57
 * Create by LZH
 */

namespace JuLongDevice\Basic\Models;

use JuLongDevice\Common\AbstractResponse;

class ActiveCaptureResponse extends AbstractResponse
{
    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {

            $activeCapture = new ActiveCapture();
            $activeCapture->deserialize($param["Data"]);

            $this->Data = $activeCapture;
        }


    }
}