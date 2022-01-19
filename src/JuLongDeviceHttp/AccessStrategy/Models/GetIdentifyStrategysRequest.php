<?php
/**
 * 文件描述
 * Created on 2021/12/31 15:19
 * Create by LZH
 */

namespace JuLongDeviceHttp\AccessStrategy\Models;

use JuLongDeviceHttp\FaceManage\PersonIdentity;

/**
 * 获取人员分组关联通行策略
 * Created on 2021/12/31 15:20
 * Create by LZH
 *
 * @property int $Type 0：查询所有关联策略；1：通过人员分组查询关联策略
 * @property PersonIdentity $PersonIdentity 人员身份：用于名单分组
 */
class GetIdentifyStrategysRequest extends AccessStrategyRequest
{
    public function __construct()
    {
        $this->Data["Action"] = "getIdentifyStrategys";
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value ) {
        $filterProperty = ["Type","PersonIdentity"];
        if(in_array($property, $filterProperty)) {
            $this->Data[$property] = $value;
        } else {
            $this->$property = $value;
        }
    }
}