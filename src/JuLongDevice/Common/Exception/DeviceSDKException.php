<?php

namespace JuLongDevice\Common\Exception;

/**
 * sdk异常类
 * Created on 2021/12/23 9:49
 * Create by LZH
 */
class DeviceSDKException extends \Exception
{
    /**
     * @var string 请求名称
     */
    private $requestName;

    private $errorCode;


    /**
     * DeviceException constructor.
     * @param string $code 异常错误码
     * @param string $message 异常信息
     * @param string $requestName 请求ID
     */
    public function __construct($code = "", $message = "", $requestName = "")
    {
        parent::__construct($message, 0);
        $this->errorCode = $code;
        $this->requestName = $requestName;
    }

    /**
     * 返回请求名称
     * @return string
     */
    public function getRequestName()
    {
        return $this->requestName;
    }

    /**
     * 返回错误码
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * 格式化输出异常码，异常信息，请求id
     * @return string
     */
    public function __toString()
    {
        return "[".__CLASS__."]"." code:".$this->errorCode.
            " message:".$this->getMessage().
            " requestName:".$this->requestName;
    }
}