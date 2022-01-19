<?php
/**
 * 文件描述
 * Created on 2021/12/29 17:02
 * Create by LZH
 */

namespace JuLongDeviceHttp\FaceManage\Models;

/**
 * 删除人员信息
 * Created on 2021/12/29 17:04
 * Create by LZH
 *
 * @property int $PersonType 名单类型
 * @property string $PersonId 人员ID
 */
class DeletePersonRequest extends PersonListRequest
{
    public function __construct()
    {
        $this->Data["Action"] = "deletePerson";
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value ) {
        $filterProperty = ["PersonType", "PersonId"];
        if(in_array($property, $filterProperty)) {
            $this->Data[$property] = $value;
        } else {
            $this->$property = $value;
        }
    }
}