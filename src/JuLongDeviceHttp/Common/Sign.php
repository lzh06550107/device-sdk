<?php

declare(strict_types=1);

namespace JuLongDeviceHttp\Common;

use JuLongDeviceHttp\Common\Exception\DeviceSDKException;

/**
 * 签名类，禁止client引用
 * Created on 2021/12/23 10:04
 * Create by LZH
 */
class Sign
{
    /**
     * @throws DeviceSDKException
     */
    public static function sign($secretKey, $signStr, $signMethod)
    {
        $signMethodMap = ["HmacSHA1" => "SHA1", "HmacSHA256" => "SHA256"];
        if (!array_key_exists($signMethod, $signMethodMap)) {
            throw new DeviceSDKException("signMethod invalid", "signMethod only support (HmacSHA1, HmacSHA256)");
        }
        $signature = base64_encode(hash_hmac($signMethodMap[$signMethod], $signStr, $secretKey, true));
        return $signature;
    }

    public static function signMd5($signStr) {
        return md5($signStr);
    }

    public static function signTC3($skey, $date, $service, $str2sign)
    {
        $dateKey = hash_hmac("SHA256", $date, "TC3".$skey, true);
        $serviceKey = hash_hmac("SHA256", $service, $dateKey, true);
        $reqKey = hash_hmac("SHA256", "tc3_request", $serviceKey, true);
        return hash_hmac("SHA256", $str2sign, $reqKey);
    }
}