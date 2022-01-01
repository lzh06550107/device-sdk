<?php
/**
 * 文件描述
 * Created on 2021/12/31 16:31
 * Create by LZH
 */

namespace JuLongDevice\AccessStrategy\Models;

use JuLongDevice\Common\AbstractRequest;

/**
 * 人员身份替换（人员换组），策略关联的分组也会改变
 * Created on 2021/12/31 16:31
 * Create by LZH
 *
 * @property int $FromIdentity 当前人员身份
 * @property int $ToIdentity 目标人员身份
 */
class IdentityChangeRequest extends AbstractRequest
{
    // 给一个未定义的属性赋值时调用
    function __set($property, $value ) {
        $filterProperty = ["FromIdentity", "ToIdentity"];
        if(in_array($property, $filterProperty)) {
            $this->Data[$property] = $value;
        } else {
            $this->$property = $value;
        }
    }
}