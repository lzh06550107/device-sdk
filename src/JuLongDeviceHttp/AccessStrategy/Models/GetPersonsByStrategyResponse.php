<?php
/**
 * 文件描述
 * Created on 2021/12/31 16:16
 * Create by LZH
 */

namespace JuLongDeviceHttp\AccessStrategy\Models;

use JuLongDeviceHttp\FaceManage\Models\PersonInfo;

class GetPersonsByStrategyResponse
{
    public $Action;
    /**
     * @var int 名单类型
     */
    public $PersonType;
    /**
     * @var int 列表页码（默认1）
     */
    public $PageNo;
    /**
     * @var int 列表单页最大数量（默认10）
     */
    public $PageSize;
    /**
     * @var int 该人员列表总数量 注：不是当前返回列表数量
     */
    public $PersonCount;
    /**
     * @var PersonInfo[] 获取到的名单列表
     */
    public $PersonList;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("Action",$param) and $param["Action"] !== null) {
            $this->Action = $param['Action'];
        }

        if (array_key_exists("PersonType",$param) and $param["PersonType"] !== null) {
            $this->PersonType = $param['PersonType'];
        }

        if (array_key_exists("PageNo",$param) and $param["PageNo"] !== null) {
            $this->PageNo = $param['PageNo'];
        }

        if (array_key_exists("PageSize",$param) and $param["PageSize"] !== null) {
            $this->PageSize = $param['PageSize'];
        }

        if (array_key_exists("PersonCount",$param) and $param["PersonCount"] !== null) {
            $this->PersonCount = $param['PersonCount'];
        }

        if (array_key_exists("PersonList",$param) and $param["PersonList"] !== null) {
            $personListResult = [];
            foreach ($param['PersonList'] as $personInfo) {
                $personInfoObj = new PersonInfo();
                $personInfoObj->deserialize($personInfo);
                $personListResult[] = $personInfoObj;
            }
            $this->PersonList = $personListResult;
        }

    }
}