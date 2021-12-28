<?php

use JuLongDevice\Common\Exception\DeviceSDKException;
use JuLongDevice\Common\Profile\ClientProfile;
use JuLongDevice\Common\Profile\HttpProfile;
use JuLongDevice\ParamSetting\Models\GPSParameters;
use JuLongDevice\ParamSetting\Models\SetGPSParametersRequest;
use JuLongDevice\ParamSetting\ParamSettingClient;

require_once '../../vendor/autoload.php';

try {
    // 实例化一个http选项，可选的，没有特殊需求可以跳过
    $httpProfile = new HttpProfile();
    // 配置代理
    // $httpProfile->setProxy("https://ip:port");
    $httpProfile->setReqMethod(HttpProfile::$REQ_POST);  // post请求(默认为post请求)
    $httpProfile->setReqTimeout(30);    // 请求超时时间，单位为秒(默认60秒)
    $httpProfile->setEndpoint("128.128.20.131:8011");  // 指定接入设备地址
    $httpProfile->setProtocol(HttpProfile::$REQ_HTTP);

    // 实例化一个client选项，可选的，没有特殊需求可以跳过
    $clientProfile = new ClientProfile();
    // 这里使用md5签名验证，需要设备开启Sign验证
//    $clientProfile->setSignMethod(ClientProfile::$SIGN_MD5);  // 指定签名算法(默认为md5)
//    $clientProfile->setUUID("umethqdt2gm9");
//    $clientProfile->setDeviceAdmin("admin");
//    $clientProfile->setDevicePassword("admin");
    $clientProfile->setHttpProfile($httpProfile);

    // 实例化要请求client对象,clientProfile是可选的
    $client = new ParamSettingClient($clientProfile);

    // 实例化一个请求对象,每个接口都会对应一个request对象。
    $req = new SetGPSParametersRequest();
    $req->TimeStamp = time();
    // 需要设备开启注册
    $req->Session = 'fdjlsfjeowjfldsfa';

    $gpsParameters = new GPSParameters();
    $gpsParameters->GPSEnabled = 1;
    $gpsParameters->GPSInfoInterval = 5;
    $gpsParameters->Longitude = "22.351469N";
    $gpsParameters->Latitude = "113.545471E";
    $gpsParameters->Altitude = "44.6";
    $gpsParameters->Time = "10:55:58";
    $gpsParameters->Date = "2021-05-19";
    $gpsParameters->Speed = "0.97";
    $gpsParameters->CNR = 24;

    $req->Data = $gpsParameters;

    // 通过client对象调用 setGPSParameters 方法发起请求。注意请求方法名与请求对象是对应的
    // 返回的resp是一个 SetGPSParametersResponse 类的实例，与请求对象对应
    $resp = $client->setGPSParameters($req);

    var_dump($resp);

    // 输出json格式的字符串回包
    print_r($resp->toJsonString());

    // 也可以取出单个值。
    // 你可以通过官网接口文档或跳转到response对象的定义处查看返回字段的定义
    print_r($resp->getName());
} catch (DeviceSDKException $e) {
    echo $e;
}