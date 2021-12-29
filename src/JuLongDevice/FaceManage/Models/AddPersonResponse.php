<?php
/**
 * 文件描述
 * Created on 2021/12/28 18:25
 * Create by LZH
 */

namespace JuLongDevice\FaceManage\Models;

class AddPersonResponse
{
    public $Action;
    public $PersonType;
    public $PersonInfo;
    public $Result;

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

        if (array_key_exists("PersonInfo",$param) and $param["PersonInfo"] !== null) {
            $this->PersonInfo = $param['PersonInfo'];
        }

        if (array_key_exists("Result",$param) and $param["Result"] !== null) {
            $this->Result = $param['Result'];
        }

    }
}