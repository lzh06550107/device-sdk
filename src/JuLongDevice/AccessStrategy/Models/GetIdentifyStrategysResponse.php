<?php
/**
 * 文件描述
 * Created on 2021/12/31 15:25
 * Create by LZH
 */

namespace JuLongDevice\AccessStrategy\Models;

class GetIdentifyStrategysResponse
{
    /**
     * @var string 动作
     */
    public $Action;

    /**
     * @var IdentifyStrategys[] 人员分组关联通行策略列表
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
                $getIdentifyStrategys = new IdentifyStrategys();
                $getIdentifyStrategys->deserialize($list);
                $listResult[] = $getIdentifyStrategys;
            }
            $this->List = $listResult;
        }

    }
}