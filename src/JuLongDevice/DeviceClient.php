<?php

namespace JuLongDevice;

/**
 * 请求设备接口类
 * Created on 2021/12/23 10:24
 * Create by LZH
 */
class DeviceClient
{

    /**
     * 对应http文档协议版本
     * @var string
     */
    protected $version = "2021-09-08";

    /**
     * 客户端配置
     */
    protected $config = [];

    /**
     * @param $config array 客户端配置
     */
    function __construct(array $config)
    {
        $this->config = $config;
    }



}