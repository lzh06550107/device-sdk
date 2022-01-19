<?php

namespace JuLongDeviceHttp\FaceManage;

/**
 * 名单类型
 * Created on 2021/12/28 14:14
 * Create by LZH
 */
class PersonType
{
    /**
     * @var int 所有名单
     */
    public static $ALL_FACE = 0;
    /**
     * @var int 黑名单
     */
    public static $BLACK_FACE = 1;
    /**
     * @var int 白名单
     */
    public static $WHITE_FACE = 2;
    /**
     * @var int VIP名单
     */
    public static $VIP_FACE = 3;
}