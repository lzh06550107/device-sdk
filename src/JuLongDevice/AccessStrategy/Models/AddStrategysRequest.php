<?php
/**
 * 文件描述
 * Created on 2021/12/31 10:20
 * Create by LZH
 */

namespace JuLongDevice\AccessStrategy\Models;

/**
 * 添加/修改通行策略
 * Created on 2021/12/31 10:21
 * Create by LZH
 *
 * @property StrategyInfo[] $StrategyList 通行策略列表
 */
class AddStrategysRequest extends AccessStrategyRequest
{
    public function __construct()
    {
        $this->Data["Action"] = "addStrategys";
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value ) {
        $filterProperty = ["StrategyList"];
        if(in_array($property, $filterProperty)) {
            $this->Data[$property] = $value;
        } else {
            $this->$property = $value;
        }
    }
}