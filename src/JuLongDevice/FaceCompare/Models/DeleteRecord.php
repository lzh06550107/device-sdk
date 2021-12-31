<?php
/**
 * 文件描述
 * Created on 2021/12/30 14:55
 * Create by LZH
 */

namespace JuLongDevice\FaceCompare\Models;

use JuLongDevice\Common\AbstractModel;

class DeleteRecord extends AbstractModel
{
    /**
     * @var int 删除模式
     * 0：单个删除（按ID）
     * 1：按时间段删除
     * 2：全部删除
     */
    public $Mode;
    /**
     * @var string 开始时间，格式：yyyy-mm-dd hh:mm:ss
     */
    public $BeginTime;
    /**
     * @var string 结束时间，格式：yyyy-mm-dd hh:mm:ss
     */
    public $EndTime;
    /**
     * @var int 失败记录ID
     */
    public $RecordId;
}