<?php
/**
 * 文件描述
 * Created on 2022/1/4 11:29
 * Create by LZH
 */

namespace JuLongDevice\AccessControlPassword\Models;

/**
 * 类文件描述
 * Created on 2022/1/4 11:38
 * Create by LZH
 *
 * @property PasswordInfo[] $List 添加的密码列表
 */
class EditPasswordsRequest extends PasswordListRequest
{
    public function __construct()
    {
        $this->Data["Action"] = "editPasswords";
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