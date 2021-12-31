<?php
/**
 * 文件描述
 * Created on 2021/12/30 13:37
 * Create by LZH
 */

namespace JuLongDevice\FaceCompare\Models;

use JuLongDevice\Common\AbstractModel;

class HistoryRecord extends AbstractModel
{
    /**
     * @var int 获取记录指令
     *
     * 0：获取上报状态
     * 1：获取上报记录
     * 2：取消上报记录
     * 3：获取历史记录总数
     */
    public $Action;
    /**
     * @var string 开始时间，格式：yyyy-mm-dd hh:mm:ss
     */
    public $BeginTime;
    /**
     * @var string 结束时间，格式：yyyy-mm-dd hh:mm:ss
     */
    public $EndTime;
    /**
     * @var int 搜索方式(时间范围内)
     *
     * 0：全部（默认）
     * 1：人员ID
     */
    public $SearchType;
    /**
     * @var string 人员ID
     */
    public $PersonId;
}