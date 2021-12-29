<?php
/**
 * 文件描述
 * Created on 2021/12/28 16:43
 * Create by LZH
 */

namespace JuLongDevice\FaceManage\Models;

class GetPersonListResponse
{

    public $Action;
    public $PersonType;
    public $PageNo;
    public $PageSize;
    public $PageCount;
    public $PersonCount;
    public $PersonListNum;
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

        if (array_key_exists("PageCount",$param) and $param["PageCount"] !== null) {
            $this->PageCount = $param['PageCount'];
        }

        if (array_key_exists("PersonCount",$param) and $param["PersonCount"] !== null) {
            $this->PersonCount = $param['PersonCount'];
        }

        if (array_key_exists("PersonListNum",$param) and $param["PersonListNum"] !== null) {
            $this->PersonListNum = $param['PersonListNum'];
        }

        if (array_key_exists("PersonList",$param) and $param["PersonList"] !== null) {
            $this->PersonList = $param["PersonList"];
        }

    }
}