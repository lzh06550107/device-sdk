<?php
/**
 * 文件描述
 * Created on 2021/12/30 9:48
 * Create by LZH
 */

namespace JuLongDevice\FaceManage\Models;

/**
 * 批量删除人员
 * Created on 2021/12/30 9:49
 * Create by LZH
 *
 * @property int $PersonType 名单类型
 * @property array $PersonList 批量人员列表
 */
class DeletePersonsRequest extends PersonListRequest
{
    public function __construct()
    {
        $this->Data["Action"] = "deletePersons";
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value ) {
        $filterProperty = ["PersonType", "PersonList"];
        if(in_array($property, $filterProperty)) {
            $this->Data[$property] = $value;
        } else {
            $this->$property = $value;
        }
    }
}