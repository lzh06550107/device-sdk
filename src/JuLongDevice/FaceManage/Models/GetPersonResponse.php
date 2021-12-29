<?php
/**
 * 文件描述
 * Created on 2021/12/28 17:08
 * Create by LZH
 */

namespace JuLongDevice\FaceManage\Models;

use JuLongDevice\FaceManage\PersonIdentity;

class GetPersonResponse
{
    public $Action;
    public $PersonType;
    public $PersonInfo;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("Action", $param) and $param["Action"] !== null) {
            $this->Action = $param['Action'];
        }

        if (array_key_exists("PersonType", $param) and $param["PersonType"] !== null) {
            $this->PersonType = $param['PersonType'];
        }

        if (array_key_exists("PersonInfo", $param) and $param["PersonInfo"] !== null) {
            $personInfo = new PersonInfo();
            $personInfo->deserialize($param['PersonInfo']);
            $this->PersonInfo = $personInfo;
        }

    }
}