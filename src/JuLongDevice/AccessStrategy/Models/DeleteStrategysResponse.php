<?php
/**
 * 文件描述
 * Created on 2021/12/31 11:36
 * Create by LZH
 */

namespace JuLongDevice\AccessStrategy\Models;

class DeleteStrategysResponse
{
    /**
     * @var string 动作
     */
    public $Action;

    /**
     * @var int 0：删除所有策略；1：通过ID删除策略
     */
    public $Type;


    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("Action",$param) and $param["Action"] !== null) {
            $this->Action = $param['Action'];
        }

        if (array_key_exists("Type",$param) and $param["Type"] !== null) {
            $this->Type = $param['Type'];
        }

    }
}