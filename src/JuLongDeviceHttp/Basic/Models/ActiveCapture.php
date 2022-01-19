<?php
/**
 * 文件描述
 * Created on 2021/12/28 11:56
 * Create by LZH
 */

namespace JuLongDeviceHttp\Basic\Models;

use JuLongDeviceHttp\Common\AbstractModel;

/**
 * 主动抓拍
 * Created on 2021/12/28 13:58
 * Create by LZH
 */
class ActiveCapture extends AbstractModel
{
    public $BackgroundPicture;

    public function deserialize($param) {

        if ($param === null) {
            return;
        }

        if (array_key_exists("BackgroundPicture",$param) and $param["BackgroundPicture"] !== null) {
            $this->BackgroundPicture = $param["BackgroundPicture"];
        }

    }
}