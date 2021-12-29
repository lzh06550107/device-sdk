<?php
/**
 * 文件描述
 * Created on 2021/12/29 15:59
 * Create by LZH
 */

namespace JuLongDevice\FaceManage\Models;

// 添加人员需要的类
class AddPersonInfo extends PersonInfo
{
    /**
     * @var int 是否覆盖添加
     */
    public $PersonCover;

    public function deserialize($param)
    {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (array_key_exists("PersonCover", $param) and $param["PersonCover"] !== null) {
            $this->PersonCover = $param['PersonCover'];
        }
    }
}