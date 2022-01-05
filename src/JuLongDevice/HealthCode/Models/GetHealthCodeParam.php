<?php
/**
 * 文件描述
 * Created on 2022/1/4 13:56
 * Create by LZH
 */

namespace JuLongDevice\HealthCode\Models;

use JuLongDevice\Common\AbstractModel;

class GetHealthCodeParam extends AbstractModel
{
    /**
     * @var int 获取类型：1：通过身份证信息获取；2：通过二维码信息获取（暂不支持）
     */
    public $GetType;
    /**
     * @var IDCardInfo $IDCardInfo 身份证信息
     */
    public $IDCardInfo;
    /**
     * @var string 人员照片(base64编码)
     */
    public $PersonPhoto;
}