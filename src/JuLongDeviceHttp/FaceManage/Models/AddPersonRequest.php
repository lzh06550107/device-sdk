<?php
/**
 * 文件描述
 * Created on 2021/12/28 17:59
 * Create by LZH
 */

namespace JuLongDeviceHttp\FaceManage\Models;

use JuLongDeviceHttp\AccessControlPassword\Models\PasswordListRequest;

/**
 * 添加人员信息
 * Created on 2021/12/28 18:06
 * Create by LZH
 *
 * @property int $AddType 添加方式
 * @property int $PersonType 名单类型
 * @property AddPersonInfo $PersonInfo 添加人员信息
 */
class AddPersonRequest extends PasswordListRequest
{

    public function __construct()
    {
        $this->Data["Action"] = "addPerson";
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