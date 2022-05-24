<?php
/**
 * 文件描述
 * Created on 2021/12/28 17:07
 * Create by LZH
 */

namespace JuLongDeviceHttp\FaceManage\Models;

use JuLongDeviceHttp\FaceManage\FaceManageAction;

/**
 * 获取名单列表
 * Created on 2021/12/28 16:13
 * Create by LZH
 *
 * @property int $PersonType 名单类型
 * @property int $PersonId 人员ID
 * @property int $GetPhoto 是否获取图片数据
 */
class GetPersonRequest extends PersonListRequest
{

    public function __construct()
    {
        $this->Data["Action"] = FaceManageAction::GET_PERSON;
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value ) {
        $filterProperty = ["PersonType", "PersonId", "GetPhoto"];
        if(in_array($property, $filterProperty)) {
            $this->Data[$property] = $value;
        } else {
            $this->$property = $value;
        }
    }
}