<?php
/**
 * 文件描述
 * Created on 2021/12/31 14:31
 * Create by LZH
 */

namespace JuLongDevice\AccessStrategy\Models;

class PersonBindStrategysResponse
{
    /**
     * @var string 动作
     */
    public $Action;

    /**
     * @var PersonStrategysResult[] 人员绑定通行策略列表
     */
    public $List;


    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("Action",$param) and $param["Action"] !== null) {
            $this->Action = $param['Action'];
        }

        if (array_key_exists("List",$param) and $param["List"] !== null) {
            $listResult = [];
            foreach ($param['List'] as $list) {
                $personBindStrategysResult = new PersonStrategysResult();
                $personBindStrategysResult->deserialize($list);
                $listResult[] = $personBindStrategysResult;
            }
            $this->List = $listResult;
        }

    }
}