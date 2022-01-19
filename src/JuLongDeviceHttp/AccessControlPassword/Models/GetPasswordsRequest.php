<?php
/**
 * 文件描述
 * Created on 2022/1/4 11:59
 * Create by LZH
 */

namespace JuLongDeviceHttp\AccessControlPassword\Models;

/**
 * 类文件描述
 * Created on 2022/1/4 12:01
 * Create by LZH
 *
 * @property int $Type 查询类型：0：全部查询（所有）；1：条件查询（指定条件）
 * @property int $PageNo 列表页码（默认1）
 * @property int $PageSize 列表单页数量（默认10）
 * @property PasswordInfo $PasswordInfo 门禁密码信息（传指定条件的参数）
 */
class GetPasswordsRequest extends PasswordListRequest
{
    public function __construct()
    {
        $this->Data["Action"] = "getPasswords";
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value ) {
        $filterProperty = ["Type", "PageNo", "PageSize", "PasswordInfo"];
        if(in_array($property, $filterProperty)) {
            $this->Data[$property] = $value;
        } else {
            $this->$property = $value;
        }
    }
}