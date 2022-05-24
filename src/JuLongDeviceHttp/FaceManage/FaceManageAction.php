<?php

namespace JuLongDeviceHttp\FaceManage;

/**
 * 名单管理请求动作类
 * Created on 2021/12/28 14:05
 * Create by LZH
 */
class FaceManageAction
{
    /**
     * 获取名单列表
     */
    public const GET_PERSON_LIST = "getPersonList";
    /**
     * 获取人员信息
     */
    public const GET_PERSON = "getPerson";
    /**
     * 添加人员信息
     */
    public const ADD_PERSON = "addPerson";
    /**
     * 编辑人员信息
     */
    public const EDIT_PERSON = "editPerson";
    /**
     * 删除人员信息
     */
    public const DELETE_PERSON = "deletePerson";
    /**
     * 删除名单库（名单分组）
     */
    public const DELETE_PERSON_LIST = "deletePersonList";
    /**
     * 批量添加人员
     */
    public const ADD_PERSONS = "addPersons";
    /**
     * 批量删除人员
     */
    public const DELETE_PERSONS = "deletePersons";

}