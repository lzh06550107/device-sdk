<?php
/**
 * 文件描述
 * Created on 2022/1/4 10:27
 * Create by LZH
 */

namespace JuLongDevice\AccessControlPassword\Models;

use JuLongDevice\Common\AbstractModel;

class PasswordInfo extends AbstractModel
{
    /**
     * @var string 密码ID
     */
    public $PasswordId;
    /**
     * @var int 密码类型 1：临时密码；2：永久密码
     */
    public $PasswordType;
    /**
     * @var int 密码加密类型 0：无（不加密）；1：base64加密
     */
    public $EncryptType;
    /**
     * @var string 门禁密码（根据加密类型加密）
     */
    public $Password;
    /**
     * @var string 单元ID
     */
    public $UnitId;
    /**
     * @var string 房间ID
     */
    public $RoomId;
    /**
     * @var string 户主姓名（添加临时密码/永久密码的户主）
     */
    public $UserName;
    /**
     * @var string 临时用户姓名（使用临时密码的访客）
     */
    public $TempUserName;
    /**
     * @var int 访客类型 0：朋友；1：外卖；2：快递；3：其他
     */
    public $GuestType;
    /**
     * @var int 临时密码有效次数
     */
    public $ValidCount;
    /**
     * @var string 添加时间 格式：yyyy-mm-dd hh:mm:ss
     */
    public $SaveTime;
    /**
     * @var string 有效开始时间 格式：yyyy-mm-dd hh:mm:ss
     */
    public $StartTime;
    /**
     * @var string 有效结束时间 格式：yyyy-mm-dd hh:mm:ss
     */
    public $EndTime;
}