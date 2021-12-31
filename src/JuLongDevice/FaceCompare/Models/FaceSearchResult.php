<?php
/**
 * 文件描述
 * Created on 2021/12/31 9:05
 * Create by LZH
 */

namespace JuLongDevice\FaceCompare\Models;

use JuLongDevice\Common\AbstractModel;
use JuLongDevice\FaceManage\Models\PersonInfo;
use JuLongDevice\FaceManage\PersonType;

class FaceSearchResult extends AbstractModel
{
    /**
     * @var PersonType 名单类型
     * 0：陌生人
     * 1：黑名单
     * 2：白名单
     * 3：VIP名单
     */
    public $PersonType;
    /**
     * @var string 相似度，格式：0.1000
     */
    public $Similarity;
    /**
     * @var PersonInfo 人员信息
     */
    public $PersonInfo;

    public function deserialize($param) {

        if ($param === null) {
            return;
        }

        if (array_key_exists("PersonType",$param) and $param["PersonType"] !== null) {
            $this->PersonType = $param['PersonType'];
        }

        if (array_key_exists("Similarity",$param) and $param["Similarity"] !== null) {
            $this->Similarity = $param['Similarity'];
        }

        if (array_key_exists("PersonInfo",$param) and $param["PersonInfo"] !== null) {
            $personInfo = new PersonInfo();
            $personInfo->deserialize($param['PersonInfo']);
            $this->PersonInfo = $personInfo;
        }

    }
}