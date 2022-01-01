<?php
/**
 * 文件描述
 * Created on 2021/12/31 15:08
 * Create by LZH
 */

namespace JuLongDevice\AccessStrategy\Models;

/**
 * 人员解绑通行策略
 * Created on 2021/12/31 15:08
 * Create by LZH
 *
 * @property PersonStrategys[] $List 人员解绑通行策略列表
 */
class PersonUnBindStrategysRequest extends AccessStrategyRequest
{
    public function __construct()
    {
        $this->Data["Action"] = "personUnBindStrategys";
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