<?php
/**
 * 文件描述
 * Created on 2021/12/31 11:36
 * Create by LZH
 */

namespace JuLongDevice\AccessStrategy\Models;

/**
 * 添加/修改通行策略
 * Created on 2021/12/31 10:21
 * Create by LZH
 *
 * @property int $Type 0：删除所有策略；1：通过ID删除策略
 * @property StrategyInfo[] $StrategyList 通行策略列表
 */
class DeleteStrategysRequest extends AccessStrategyRequest
{
    public function __construct()
    {
        $this->Data["Action"] = "deleteStrategys";
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value ) {
        $filterProperty = ["Type","StrategyList"];
        if(in_array($property, $filterProperty)) {
            $this->Data[$property] = $value;
        } else {
            $this->$property = $value;
        }
    }
}