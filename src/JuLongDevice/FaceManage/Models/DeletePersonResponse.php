<?php
/**
 * 文件描述
 * Created on 2021/12/29 17:09
 * Create by LZH
 */

namespace JuLongDevice\FaceManage\Models;

use JuLongDevice\FaceManage\PersonType;

class DeletePersonResponse
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
     * @var string 添加的人员信息
     */
    public $PersonId;
    /**
     * @var int 内部错误码
     */
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

        if (array_key_exists("PersonId",$param) and $param["PersonId"] !== null) {
            $this->PersonId = $param['PersonId'];
        }

        if (array_key_exists("Result",$param) and $param["Result"] !== null) {
            $this->Result = $param['Result'];
        }

    }
}