<?php
/**
 * 文件描述
 * Created on 2021/12/24 15:08
 * Create by LZH
 */

namespace JuLongDevice\Common;

class AbstractResponse extends AbstractModel
{
    /**
     * @var int 错误码
     */
    public $errorCode;

    /**
     * @var string 错误消息
     */
    public $result;

    /**
     * @var int 返回操作码，判断请求是否成功，见Code说明列表
     */
    public $code;

    /**
     * @var string 返回操作信息，Code相关描述信息
     */
    public $message;

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("ErrorCode",$param) and $param["ErrorCode"] !== null) {
            $this->errorCode = $param["ErrorCode"];
        }

        if (array_key_exists("Result",$param) and $param["Result"] !== null) {
            $this->result = $param["Result"];
        }

        if (array_key_exists("Code",$param) and $param["Code"] !== null) {
            $this->code = $param["Code"];
        }

        if (array_key_exists("Message",$param) and $param["Message"] !== null) {
            $this->message = $param["Message"];
        }

    }
}