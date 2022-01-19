<?php
/**
 * 文件描述
 * Created on 2021/12/30 9:07
 * Create by LZH
 */

namespace JuLongDeviceHttp\FaceManage\Models;

/**
 * 批量添加人员，组成请求的Json总大小不要超过5M，不需要的字段可以不带。
 * Created on 2021/12/30 9:10
 * Create by LZH
 *
 * @property int $AddType 添加方式
 * @property int $PersonType 名单类型
 * @property int $PersonCover 是否覆盖添加
 * @property array $PersonList 批量人员列表
 */
class AddPersonsRequest extends PersonListRequest
{
    public function __construct()
    {
        $this->Data["Action"] = "addPersons";
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value ) {
        $filterProperty = ["AddType", "PersonType", "PersonCover", "PersonList"];
        if(in_array($property, $filterProperty)) {
            $this->Data[$property] = $value;
        } else {
            $this->$property = $value;
        }
    }
}