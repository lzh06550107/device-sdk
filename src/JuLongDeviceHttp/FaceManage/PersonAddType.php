<?php

namespace JuLongDeviceHttp\FaceManage;

/**
 * 人员信息添加方式
 * Created on 2021/12/28 14:17
 * Create by LZH
 */
class PersonAddType
{
    /**
     * @var int 图片添加
     */
    public static $IMAGE_ADD = 0;
    /**
     * @var int 特征值添加，同步
     */
    public static $FEATURE_VALUE_ADD_SYNCHRONIZATION = 1;
    /**
     * @var int 特征值添加，异步
     */
    public static $FEATURE_VALUE_ADD_ASYNCHRONIZATION = 2;
    /**
     * @var int IC卡添加（只识别IC卡不识别人脸）
     */
    public static $IC_CARD_ADD = 3;
}