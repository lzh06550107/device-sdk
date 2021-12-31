<?php
/**
 * 文件描述
 * Created on 2021/12/30 9:49
 * Create by LZH
 */

namespace JuLongDevice\FaceManage\Models;

use JuLongDevice\FaceManage\PersonType;

class DeletePersonsResponse
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
     * @var array 添加的人员信息列表
     */
    public $PersonList;


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

        if (array_key_exists("PersonList",$param) and $param["PersonList"] !== null) {
            $this->PersonList = $param["PersonList"];
        }
    }
}