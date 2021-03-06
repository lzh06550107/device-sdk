<?php

declare(strict_types=1);

namespace JuLongDeviceHttp\Common;

/**
 * 抽象model类，禁止client引用
 * Created on 2021/12/23 10:02
 * Create by LZH
 *
 * @property string $Name 请求名称
 * @property string $UUID 设备UUID
 * @property string $Session 设备会话
 */
abstract class AbstractModel
{
    /**
     * 内部实现，用户禁止调用
     */
    public function serialize()
    {
        $ret = $this->objSerialize($this);
        return $ret;
    }

    /**
     * 对象系列化，支持嵌套数组和对象
     * @param $obj
     * @return array
     * @author LZH
     * @since 2021/12/23
     */
    private function objSerialize($obj) {
        $memberRet = [];
        $ref = new \ReflectionClass(get_class($obj));
        $memberList = $ref->getProperties();
        foreach ($memberList as $x => $member)
        {
            $name = ucfirst($member->getName()); // 首字母大写
            $member->setAccessible(true); // 非public也可以操作
            $value = $member->getValue($obj);
            if ($value === null) { // 忽略值为null的属性
                continue;
            }
            if ($value instanceof AbstractModel) { // 如果还是模型对象，则递归序列化
                $memberRet[$name] = $this->objSerialize($value);
            } else if (is_array($value)) { // 如果是数组，则数组系列化
                $memberRet[$name] = $this->arraySerialize($value);
            } else {
                $memberRet[$name] = $value;
            }
        }

        // 动态属性不能通过反射获取，只能通过对象添加
        if (property_exists($obj,"Name")) {
            $memberRet['Name'] = $obj->Name;
        }
        if (property_exists($obj,"UUID")) {
            $memberRet['UUID'] = $obj->UUID;
        }
        if (property_exists($obj,"Session")) {
            $memberRet['Session'] = $obj->Session;
        }

        return $memberRet;
    }

    /**
     * 数组序列化，支持嵌套数组和对象
     * @param $memberList
     * @return array
     * @author LZH
     * @since 2021/12/23
     */
    private function arraySerialize($memberList) {
        $memberRet = [];
        foreach ($memberList as $name => $value)
        {
            if ($value === null) { // 忽略值为null的属性
                continue;
            }
            if ($value instanceof AbstractModel) { // 如果还是模型对象，则递归序列化
                $memberRet[$name] = $this->objSerialize($value);
            } elseif (is_array($value)) { // 如果是数组，则数组系列化
                $memberRet[$name] = $this->arraySerialize($value);
            }else {
                $memberRet[$name] = $value;
            }
        }
        return $memberRet;
    }

    /**
     * 数组合并，支持嵌套数组
     * @param $array
     * @param $prepend string 合并键前缀
     * @return array
     * @author LZH
     * @since 2021/12/23
     */
    private function arrayMerge($array, $prepend = null)
    {
        $results = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $results = array_merge($results, static::arrayMerge($value, $prepend.$key.'.'));
            }
            else {
                if (is_bool($value)) {
                    $results[$prepend.$key] = json_encode($value); // 布尔值转换为字符串表示
                } else {
                    $results[$prepend.$key] = $value;
                }

            }
        }
        return $results;
    }

    /**
     * 根据响应生成模型对象
     * @param $param
     * @author LZH
     * @since 2021/12/23
     */
    public function deserialize($param) {

        if ($param === null) {
            return;
        }

        if (array_key_exists("Name",$param) and $param["Name"] !== null) {
            $this->Name = $param["Name"];
        }

        if (array_key_exists("Session",$param) and $param["Session"] !== null) {
            $this->Session = $param["Session"];
        }

        if (array_key_exists("UUID",$param) and $param["UUID"] !== null) {
            $this->UUID = $param["UUID"];
        }

    }

    /**
     * @param string $jsonString json格式的字符串
     */
    public function fromJsonString($jsonString)
    {
        $arr = json_decode($jsonString, true); // json转换为数组
        $this->deserialize($arr); // 数组反序列为模型
    }

    /**
     * 模型系列化后转换为json字符串
     * @return false|string
     * @author LZH
     * @since 2021/12/23
     */
    public function toJsonString()
    {
        $r = $this->serialize();
        // it is an object rather than an array
        if (empty($r)) {
            return "{}";
        }
        return json_encode($r, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 属性set/get方法
     * @param $member string 带get/set属性名称
     * @param $param mixed 属性值
     * @author LZH
     * @since 2021/12/23
     */
    public function __call($member, $param)
    {
        $act = substr($member,0,3);
        $attr = substr($member,3);
        if ($act === "get") {
            return $this->$attr;
        } else if ($act === "set") {
            $this->$attr = $param[0];
        }
    }
}