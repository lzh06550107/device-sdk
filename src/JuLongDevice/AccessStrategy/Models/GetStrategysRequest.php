<?php
/**
 * 文件描述
 * Created on 2021/12/31 11:50
 * Create by LZH
 */

namespace JuLongDevice\AccessStrategy\Models;

/**
 * 查询通行策略
 * Created on 2021/12/31 11:50
 * Create by LZH
 *
 * @property int $Type 0：删除所有策略；1：通过ID删除策略
 * @property int $PageNo 列表页码（默认 1）
 * @property int $PageSize 列表单页最大数量（默认10）
 * @Property int $StrategyId 策略ID（Type = 1时所需参数）
 */
class GetStrategysRequest extends AccessStrategyRequest
{
    public function __construct()
    {
        $this->Data["Action"] = "getStrategys";
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value ) {
        $filterProperty = ["Type", "PageNo", "PageSize", "StrategyId"];
        if(in_array($property, $filterProperty)) {
            $this->Data[$property] = $value;
        } else {
            $this->$property = $value;
        }
    }
}