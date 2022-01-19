<?php
/**
 * 文件描述
 * Created on 2022/1/4 11:31
 * Create by LZH
 */

namespace JuLongDeviceHttp\AccessControlPassword\Models;

use JuLongDeviceHttp\Common\AbstractModel;

class EditPasswordsResponse extends AbstractModel
{
    public $Action;
    /**
     * @var AddPasswordsResult[] 批量操作结果
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

        if (array_key_exists("List",$param) and $param["List"] !== null) {
            $list_result = [];
            foreach ($param['List'] as $result) {
                $editPasswordsResult = new EditPasswordsResult();
                $editPasswordsResult->deserialize($result);
                $list_result[] = $editPasswordsResult;
            }
            $this->List = $list_result;
        }

    }
}