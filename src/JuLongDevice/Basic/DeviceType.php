<?php
/**
 * 文件描述
 * Created on 2021/12/28 14:34
 * Create by LZH
 */

namespace JuLongDevice\Basic;

/**
 * 设备类型
 * Created on 2021/12/28 14:34
 * Create by LZH
 */
class DeviceType
{
    /**
     * @var int 抓拍机
     */
    public static $CAPTURE_MACHINE = 1;
    /**
     * @var int 比对机
     */
    public static $COMPARE_MACHINE = 2;
    /**
     * @var int NVR
     */
    public static $NVR = 3;
    /**
     * @var int 比对服务器
     */
    public static $COMPARE_SERVER = 4;
    /**
     * @var int 门禁机
     */
    public static $ACCESS_CONTROL_MACHINE = 5;
}