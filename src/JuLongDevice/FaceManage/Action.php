<?php

namespace JuLongDevice\FaceManage;

/**
 * 名单管理请求动作类
 * Created on 2021/12/28 14:05
 * Create by LZH
 */
class Action
{
    /**
     * @var string 获取名单列表
     */
    public static $GET_PERSON_LIST = "getPersonList";
    /**
     * @var string 获取人员信息
     */
    public static $GET_PERSON = "getPerson";
    /**
     * @var string 添加人员信息
     */
    public static $ADD_PERSON = "addPerson";
    /**
     * @var string 编辑人员信息
     */
    public static $EDIT_PERSON = "editPerson";
    /**
     * @var string 删除人员信息
     */
    public static $DELETE_PERSON = "deletePerson";
    /**
     * @var string 删除名单库（名单分组）
     */
    public static $DELETE_PERSON_LIST = "deletePersonList";
    /**
     * @var string 批量添加人员
     */
    public static $ADD_PERSONS = "addPersons";
    /**
     * @var string 批量删除人员
     */
    public static $DELETE_PERSONS = "deletePersons";

}