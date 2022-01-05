<?php
/**
 * 文件描述
 * Created on 2022/1/4 14:06
 * Create by LZH
 */

namespace JuLongDevice\HealthCode\Models;

use JuLongDevice\Common\AbstractModel;

/**
 * 核酸检测信息
 * Created on 2022/1/4 14:07
 * Create by LZH
 */
class NATInfo extends AbstractModel
{
    /**
     * @var int 核酸检测结果 0：未知；1：阴性；2：阳性
     */
    public $NATResult;
    /**
     * @var string 核酸采集时间
     */
    public $SamplingTime;
    /**
     * @var string 核酸检测机构
     */
    public $Institution;
}