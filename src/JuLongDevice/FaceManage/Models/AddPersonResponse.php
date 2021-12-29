<?php
/**
 * 文件描述
 * Created on 2021/12/28 18:25
 * Create by LZH
 */

namespace JuLongDevice\FaceManage\Models;

use JuLongDevice\FaceManage\PersonType;

class AddPersonResponse
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
     * @var PersonInfo 添加的人员信息
     */
    public $PersonInfo;
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

        if (array_key_exists("PersonInfo",$param) and $param["PersonInfo"] !== null) {
            $personInfo = new PersonInfo();
            $personInfo->deserialize($param['PersonInfo']);
            $this->PersonInfo = $personInfo;
        }

        if (array_key_exists("Result",$param) and $param["Result"] !== null) {
            $this->Result = $param['Result'];
        }

    }
}