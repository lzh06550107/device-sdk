<?php
/**
 * 文件描述
 * Created on 2021/12/31 14:45
 * Create by LZH
 */

namespace JuLongDevice\AccessStrategy\Models;

use JuLongDevice\Common\AbstractModel;

class PersonStrategysResult extends AbstractModel
{
    /**
     * @var string 人员ID
     */
    public $PersonId;
    /**
     * @var int 操作结果
     */
    public $ResultCode;
    /**
     * @var string 结果描述
     */
    public $ResultMessage;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("PersonId",$param) and $param["PersonId"] !== null) {
            $this->PersonId = $param['PersonId'];
        }

        if (array_key_exists("ResultCode",$param) and $param["ResultCode"] !== null) {
            $this->ResultCode = $param['ResultCode'];
        }

        if (array_key_exists("ResultMessage",$param) and $param["ResultMessage"] !== null) {
            $this->ResultMessage = $param['ResultMessage'];
        }
    }
}