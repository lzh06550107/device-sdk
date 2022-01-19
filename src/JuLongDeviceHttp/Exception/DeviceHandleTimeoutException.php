<?php
/**
 * 文件描述
 * Created on 2022/1/4 16:26
 * Create by LZH
 */

namespace JuLongDeviceHttp\Exception;

use JuLongDeviceHttp\Common\Exception\DeviceSDKException;

/**
 * 设备处理超时，大多出现在设备刚启动算法未完全起来的时候进行入库的操作
 * Created on 2022/1/4 16:26
 * Create by LZH
 */
class DeviceHandleTimeoutException extends DeviceSDKException
{

}