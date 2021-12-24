<?php
/**
 * 文件描述
 * Created on 2021/12/24 16:42
 * Create by LZH
 */

namespace JuLongDevice\Basic\Models;

use JuLongDevice\Common\AbstractRequest;

/**
 * 主动获取任务请求
 * Created on 2021/12/24 16:40
 * Create by LZH
 */
class EventNotifyRequestRequest extends AbstractRequest
{
    public $ChannelNo;

    public $TimeStamp;

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("ChannelNo",$param) and $param["ChannelNo"] !== null) {
            $this->ChannelNo = $param["ChannelNo"];
        }

        if (array_key_exists("Timestamp",$param) and $param["Timestamp"] !== null) {
            $this->TimeStamp = $param["Timestamp"];
        }

    }
}