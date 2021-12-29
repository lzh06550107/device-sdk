<?php
/**
 * 文件描述
 * Created on 2021/12/29 15:51
 * Create by LZH
 */

namespace JuLongDevice\FaceManage\Models;

use JuLongDevice\Common\AbstractModel;

// 分班播报学生信息列表
class StudentsInfo extends AbstractModel
{
    /**
     * @var string 学生姓名
     */
    public $StudentName;
    /**
     * @var array 学生分班播报机编号列表
     */
    public $ReportList;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (array_key_exists("StudentName", $param) and $param["StudentName"] !== null) {
            $this->StudentName = $param['StudentName'];
        }

        if (array_key_exists("ReportList", $param) and $param["ReportList"] !== null) {
            $this->ReportList = $param['ReportList'];
        }
    }
}