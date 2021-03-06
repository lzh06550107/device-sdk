<?php
/**
 * 文件描述
 * Created on 2022/1/4 13:58
 * Create by LZH
 */

namespace JuLongDeviceHttp\HealthCode\Models;

use JuLongDeviceHttp\Common\AbstractModel;

class IDCardInfo extends AbstractModel
{
    /**
     * @var string 姓名
     */
    public $Name;
    /**
     * @var string 身份证号码
     */
    public $CardNo;

}