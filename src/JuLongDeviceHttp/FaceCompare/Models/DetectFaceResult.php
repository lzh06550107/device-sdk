<?php
/**
 * 文件描述
 * Created on 2021/12/31 9:35
 * Create by LZH
 */

namespace JuLongDeviceHttp\FaceCompare\Models;

use JuLongDeviceHttp\Common\AbstractModel;

class DetectFaceResult extends AbstractModel
{
    /**
     * @var int 是否存在人脸
     * 0：不存在
     * 1：存在
     */
    public $ExistFace;

    public function deserialize($param) {

        if ($param === null) {
            return;
        }

        if (array_key_exists("ExistFace",$param) and $param["ExistFace"] !== null) {
            $this->ExistFace = $param['ExistFace'];
        }

    }
}