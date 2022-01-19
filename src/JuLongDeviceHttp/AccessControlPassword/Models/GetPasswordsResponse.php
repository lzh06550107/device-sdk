<?php
/**
 * 文件描述
 * Created on 2022/1/4 11:59
 * Create by LZH
 */

namespace JuLongDeviceHttp\AccessControlPassword\Models;

use JuLongDeviceHttp\Common\AbstractModel;

class GetPasswordsResponse extends AbstractModel
{
    /**
     * @var string 动作名称
     */
    public $Action;
    /**
     * @var int 列表页码（默认1）
     */
    public $PageNo;
    /**
     * @var int 列表单页最大数量
     */
    public $PageSize;
    /**
     * @var int 总数量 注：不是当前返回列表数量
     */
    public $Total;
    /**
     * @var PasswordInfo[] 密码列表
     */
    public $List;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("Action",$param) and $param["Action"] !== null) {
            $this->Action = $param['Action'];
        }

        if (array_key_exists("PageNo",$param) and $param["PageNo"] !== null) {
            $this->PageNo = $param['PageNo'];
        }

        if (array_key_exists("PageSize",$param) and $param["PageSize"] !== null) {
            $this->PageSize = $param['PageSize'];
        }

        if (array_key_exists("Total",$param) and $param["Total"] !== null) {
            $this->Total = $param['Total'];
        }

        if (array_key_exists("List",$param) and $param["List"] !== null) {
            $list_result = [];
            foreach ($param['List'] as $result) {
                $passwordInfo = new PasswordInfo();
                $passwordInfo->deserialize($result);
                $list_result[] = $passwordInfo;
            }
            $this->List = $list_result;
        }

    }
}