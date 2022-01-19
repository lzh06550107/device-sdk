<?php
/**
 * 文件描述
 * Created on 2021/12/28 9:13
 * Create by LZH
 */

namespace JuLongDeviceHttp\ParamSetting\Models;

use JuLongDeviceHttp\Common\AbstractResponse;

class GetSIMCardResponse extends AbstractResponse
{
    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {

            $getSIMCard = new SIMCard();
            $getSIMCard->deserialize($param["Data"]);

            $this->Data = $getSIMCard;
        }

    }

}