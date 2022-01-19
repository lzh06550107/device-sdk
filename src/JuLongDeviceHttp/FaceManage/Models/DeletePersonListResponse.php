<?php
/**
 * 文件描述
 * Created on 2021/12/29 17:54
 * Create by LZH
 */

namespace JuLongDeviceHttp\FaceManage\Models;

use JuLongDeviceHttp\FaceManage\PersonIdentity;
use JuLongDeviceHttp\FaceManage\PersonType;

class DeletePersonListResponse
{
    /**
     * @var string 动作
     */
    public $Action;
    /**
     * @var PersonType 名单类型
     */
    public $PersonType;

    /**
     * @var PersonIdentity 人员身份：用于名单分类
     */
    public $PersonIdentity;


    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("Action",$param) and $param["Action"] !== null) {
            $this->Action = $param['Action'];
        }

        if (array_key_exists("PersonType",$param) and $param["PersonType"] !== null) {
            $this->PersonType = $param['PersonType'];
        }

        if (array_key_exists("PersonIdentity",$param) and $param["PersonIdentity"] !== null) {
            $this->PersonIdentity = $param['PersonIdentity'];
        }

    }
}