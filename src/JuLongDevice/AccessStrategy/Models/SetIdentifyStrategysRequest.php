<?php
/**
 * 文件描述
 * Created on 2021/12/31 15:53
 * Create by LZH
 */

namespace JuLongDevice\AccessStrategy\Models;

/**
 * 设置人员分组关联通行策略
 * Created on 2021/12/31 15:53
 * Create by LZH
 *
 * @property IdentifyStrategys[] $List 通行策略列表
 */
class SetIdentifyStrategysRequest extends AccessStrategyRequest
{
    public function __construct()
    {
        $this->Data["Action"] = "setIdentifyStrategys";
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value ) {
        $filterProperty = ["List"];
        if(in_array($property, $filterProperty)) {
            $this->Data[$property] = $value;
        } else {
            $this->$property = $value;
        }
    }
}