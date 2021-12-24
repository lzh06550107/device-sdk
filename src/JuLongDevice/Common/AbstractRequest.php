<?php
/**
 * 文件描述
 * Created on 2021/12/24 15:07
 * Create by LZH
 */

namespace JuLongDevice\Common;

class AbstractRequest extends AbstractModel
{

    /**
     * @var int 请求或应答的时间，Unix时间戳，单位：秒
     */
    public $timeStamp;

    /**
     * @var int NVR对接所需参数，0~n-1代表通道1~n，值255 为NVR。对接IPC不需要
     */
    public $channelNo;

    /**
     * @var string 通过规则生成的字符串，用于校验用户名密码，开启“Sign验证”时校验
     */
    public $sign;

    /**
     * @var array 接口相关的信息字段放Data对象里
     */
    public $data;


    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("TimeStamp",$param) and $param["TimeStamp"] !== null) {
            $this->timeStamp = $param["TimeStamp"];
        }

        if (array_key_exists("ChannelNo",$param) and $param["ChannelNo"] !== null) {
            $this->channelNo = $param["ChannelNo"];
        }

        if (array_key_exists("Sign",$param) and $param["Sign"] !== null) {
            $this->sign = $param["Sign"];
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {
            $this->data = $param["Data"];
        }

        if (array_key_exists("Code",$param) and $param["Code"] !== null) {
            $this->code = $param["Code"];
        }

        if (array_key_exists("Message",$param) and $param["Message"] !== null) {
            $this->message = $param["Message"];
        }
    }
}