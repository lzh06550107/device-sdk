<?php
/**
 * 文件描述
 * Created on 2021/12/28 15:05
 * Create by LZH
 */

namespace JuLongDeviceHttp\FaceManage\Models;

use JuLongDeviceHttp\Common\AbstractRequest;

// 继承PersonListRequest对象的请求处理不同，需要另外处理
class PersonListRequest extends AbstractRequest
{
    public $Name = "personList";
}