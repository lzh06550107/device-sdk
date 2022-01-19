<?php
/**
 * 文件描述
 * Created on 2021/12/31 14:36
 * Create by LZH
 */

namespace JuLongDeviceHttp\AccessStrategy\Models;

use JuLongDeviceHttp\Common\AbstractModel;

/**
 * 人员绑定通行策略
 * Created on 2021/12/31 14:36
 * Create by LZH
 */
class PersonStrategys extends AbstractModel
{
    /**
     * @var string 人员ID
     */
    public $PersonId;
    /**
     * @var int[] 关联通行策略（数组内容为关联的策略ID）
     */
    public $StrategyTable;
}