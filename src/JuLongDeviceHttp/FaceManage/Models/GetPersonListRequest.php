<?php
/**
 * 文件描述
 * Created on 2021/12/28 16:08
 * Create by LZH
 */

namespace JuLongDeviceHttp\FaceManage\Models;

/**
 * 获取名单列表
 * Created on 2021/12/28 16:13
 * Create by LZH
 *
 * @property int $PersonType 名单类型
 * @property int $PersonIdentity 人员身份
 * @property int $PageNo 列表页码
 * @property int $PageSize 列表单页最大数量
 */
class GetPersonListRequest extends PersonListRequest
{
    public function __construct()
    {
        $this->Data["Action"] = "getPersonList";
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value ) {
        $filterProperty = ["PersonType", "PersonIdentity", "PageNo", "PageSize"];
        if(in_array($property, $filterProperty)) {
            $this->Data[$property] = $value;
        } else {
            $this->$property = $value;
        }
    }

}