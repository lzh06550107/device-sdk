<?php
/**
 * 文件描述
 * Created on 2022/1/4 10:43
 * Create by LZH
 */

namespace JuLongDevice\AccessControlPassword\Models;

/**
 * 批量添加密码
 * Created on 2022/1/4 10:47
 * Create by LZH
 *
 * @property PasswordInfo[] $List 添加的密码列表
 */
class AddPasswordsRequest extends PasswordListRequest
{
    public function __construct()
    {
        $this->Data["Action"] = "addPasswords";
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