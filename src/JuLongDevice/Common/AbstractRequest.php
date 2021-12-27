<?php
/**
 * 文件描述
 * Created on 2021/12/24 15:07
 * Create by LZH
 */

namespace JuLongDevice\Common;

/**
 * 请求抽象类
 * Created on 2021/12/27 9:18
 * Create by LZH
 */
class AbstractRequest extends AbstractModel
{

    /**
     * @var int 请求或应答的时间，Unix时间戳，单位：秒
     */
    public $TimeStamp;

    /**
     * @var int NVR对接所需参数，0~n-1代表通道1~n，值255 为NVR。对接IPC不需要
     */
    public $ChannelNo;

    /**
     * @var string 通过规则生成的字符串，用于校验用户名密码，开启“Sign验证”时校验
     */
    public $Sign;

    /**
     * @var object 接口相关的信息字段放Data对象里
     */
    public $Data;


    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("TimeStamp",$param) and $param["TimeStamp"] !== null) {
            $this->TimeStamp = $param["TimeStamp"];
        }

        if (array_key_exists("ChannelNo",$param) and $param["ChannelNo"] !== null) {
            $this->ChannelNo = $param["ChannelNo"];
        }

        if (array_key_exists("Sign",$param) and $param["Sign"] !== null) {
            $this->Sign = $param["Sign"];
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {
            $this->Data = $param["Data"];
        }
    }
}