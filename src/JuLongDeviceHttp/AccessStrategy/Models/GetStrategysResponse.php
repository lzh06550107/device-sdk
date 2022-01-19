<?php
/**
 * 文件描述
 * Created on 2021/12/31 11:51
 * Create by LZH
 */

namespace JuLongDeviceHttp\AccessStrategy\Models;

class GetStrategysResponse
{
    /**
     * @var string 动作
     */
    public $Action;
    /**
     * @var int 0：查询所有策略；1：通过ID查询策略
     */
    public $Type;
    /**
     * @var int 列表页码（默认 1）
     */
    public $PageNo;
    /**
     * @var int 列表单页最大数量（默认 10）
     */
    public $PageSize;
    /**
     * @var int 策略总数量（符合查询条件的） 注：不是当前返回列表数量
     */
    public $StrategyCount;
    /**
     * @var StrategyInfo[] 通行策略信息
     */
    public $StrategyList;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("Action",$param) and $param["Action"] !== null) {
            $this->Action = $param['Action'];
        }

        if (array_key_exists("Type",$param) and $param["Type"] !== null) {
            $this->Type = $param['Type'];
        }

        if (array_key_exists("PageNo",$param) and $param["PageNo"] !== null) {
            $this->PageNo = $param['PageNo'];
        }

        if (array_key_exists("PageSize",$param) and $param["PageSize"] !== null) {
            $this->PageSize = $param['PageSize'];
        }

        if (array_key_exists("StrategyCount",$param) and $param["StrategyCount"] !== null) {
            $this->StrategyCount = $param['StrategyCount'];
        }

        if (array_key_exists("StrategyList",$param) and $param["StrategyList"] !== null) {
            $strategyList = [];
            foreach ($param['StrategyList'] as $strategyInfo) {
                $strategyInfoObj = new StrategyInfo();
                $strategyInfoObj->deserialize($strategyInfo);
                $strategyList[] = $strategyInfoObj;
            }
            $this->StrategyList = $strategyList;
        }

    }
}