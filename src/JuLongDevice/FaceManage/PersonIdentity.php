<?php

namespace JuLongDevice\FaceManage;

/**
 * 人员身份，用于名单分类
 * Created on 2021/12/28 14:22
 * Create by LZH
 */
class PersonIdentity
{
    /**
     * @var int 所有分类
     */
    public static $ALL = 0;
    /**
     * @var int 老师
     */
    public static $TEACHER = 1;
    /**
     * @var int 走读学生
     */
    public static $DAY_STUDENT = 2;
    /**
     * @var int 寄宿学生
     */
    public static $BOARDING_STUDENT = 3;
    /**
     * @var int 访客
     */
    public static $VISITOR  = 4;

    public static function getPersonGroupNameById(int $id) {
        $GroupNames = [
            "所有分组",
            "老师",
            "走读学生",
            "寄宿学生",
            "访客"
        ];
        return $GroupNames[$id] ?? '未知分组';

    }
}