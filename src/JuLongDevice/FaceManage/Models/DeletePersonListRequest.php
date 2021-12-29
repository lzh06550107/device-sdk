<?php
/**
 * 文件描述
 * Created on 2021/12/29 17:41
 * Create by LZH
 */

namespace JuLongDevice\FaceManage\Models;

use JuLongDevice\FaceManage\PersonIdentity;

/**
 * 删除名单库（名单分组）
 * Created on 2021/12/29 17:42
 * Create by LZH
 *
 * @property int $PersonType 名单类型
 * @property PersonIdentity $PersonIdentity 人员身份，用于名单分类
 */
class DeletePersonListRequest extends PersonListRequest
{
    public function __construct()
    {
        $this->Data["Action"] = "deletePersonList";
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value ) {
        $filterProperty = ["PersonType", "PersonIdentity"];
        if(in_array($property, $filterProperty)) {
            $this->Data[$property] = $value;
        } else {
            $this->$property = $value;
        }
    }
}