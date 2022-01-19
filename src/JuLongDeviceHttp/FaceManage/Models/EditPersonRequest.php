<?php
/**
 * 文件描述
 * Created on 2021/12/29 16:35
 * Create by LZH
 */

namespace JuLongDeviceHttp\FaceManage\Models;

/**
 * 编辑人员信息
 * Created on 2021/12/29 16:35
 * Create by LZH
 *
 * @property int $AddType 添加方式
 * @property int $PersonType 名单类型
 * @property PersonInfo $PersonInfo 添加人员信息
 */
class EditPersonRequest extends PersonListRequest
{
    public function __construct()
    {
        $this->Data["Action"] = "editPerson";
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value ) {
        $filterProperty = ["AddType", "PersonType", "PersonInfo"];
        if(in_array($property, $filterProperty)) {
            $this->Data[$property] = $value;
        } else {
            $this->$property = $value;
        }
    }
}