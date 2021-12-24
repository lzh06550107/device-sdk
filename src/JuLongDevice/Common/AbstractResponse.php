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
     * @var int 返回操作码，判断请求是否成功，见Code说明列表
     */
    public $Code;

    /**
     * @var string 返回操作信息，Code相关描述信息
     */
    public $Message;

    /**
     * @var object 响应数据
     */
    public $Data;

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("ErrorCode",$param) and $param["ErrorCode"] !== null) {
            $this->ErrorCode = $param["ErrorCode"];
        }

        if (array_key_exists("Result",$param) and $param["Result"] !== null) {
            $this->Result = $param["Result"];
        }

        if (array_key_exists("Code",$param) and $param["Code"] !== null) {
            $this->Code = $param["Code"];
        }

        if (array_key_exists("Message",$param) and $param["Message"] !== null) {
            $this->Message = $param["Message"];
        }

        if (array_key_exists("Data",$param) and $param["Data"] !== null) {
            $this->Data = $param["Data"];
        }

    }
}