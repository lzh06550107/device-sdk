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
     * 图片添加
     */
    public const IMAGE_ADD = 0;
    /**
     * 特征值添加，同步
     */
    public const FEATURE_VALUE_ADD_SYNCHRONIZATION = 1;
    /**
     * 特征值添加，异步
     */
    public const FEATURE_VALUE_ADD_ASYNCHRONIZATION = 2;
    /**
     * IC卡添加（只识别IC卡不识别人脸）
     */
    public const IC_CARD_ADD = 3;
}