<?php
/**
 * 文件描述
 * Created on 2021/12/31 16:10
 * Create by LZH
 */

namespace JuLongDevice\AccessStrategy\Models;

use JuLongDevice\FaceManage\PersonType;

/**
 * 获取通行策略绑定人员列表
 * Created on 2021/12/31 16:10
 * Create by LZH
 *
 * @property PersonType $PersonType 名单类型
 * @property int $PageNo 列表页码（默认 1）
 * @property int $PageSize 列表单页最大数量（默认10）
 * @property int $StrategyId 策略ID
 */
class GetPersonsByStrategyRequest extends AccessStrategyRequest
{
    public function __construct()
    {
        $this->Data["Action"] = "getPersonsByStrategy";
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value ) {
        $filterProperty = ["PersonType", "PageNo", "PageSize", "StrategyId"];
        if(in_array($property, $filterProperty)) {
            $this->Data[$property] = $value;
        } else {
            $this->$property = $value;
        }
    }
}