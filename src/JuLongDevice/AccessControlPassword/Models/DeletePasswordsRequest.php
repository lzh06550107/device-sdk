<?php
/**
 * 文件描述
 * Created on 2022/1/4 11:39
 * Create by LZH
 */

namespace JuLongDevice\AccessControlPassword\Models;

/**
 * 批量删除密码
 * Created on 2022/1/4 11:39
 * Create by LZH
 *
 * @property int $Type 删除类型：0：全部删除（所有）；1：列表删除（指定列表）
 * @property String[] $List 删除的密码ID列表
 */
class DeletePasswordsRequest extends PasswordListRequest
{
    public function __construct()
    {
        $this->Data["Action"] = "deletePasswords";
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value ) {
        $filterProperty = ["Type", "List"];
        if(in_array($property, $filterProperty)) {
            $this->Data[$property] = $value;
        } else {
            $this->$property = $value;
        }
    }
}