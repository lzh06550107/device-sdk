<?php

use JuLongDevice\AccessControlPassword\AccessControlPasswordClient;
use JuLongDevice\AccessControlPassword\Models\EditPasswordsRequest;
use JuLongDevice\AccessControlPassword\Models\PasswordInfo;
use JuLongDevice\Common\Exception\DeviceSDKException;
use JuLongDevice\Common\Profile\ClientProfile;
use JuLongDevice\Common\Profile\HttpProfile;

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
    $client = new AccessControlPasswordClient($clientProfile);

    // 实例化一个请求对象,每个接口都会对应一个request对象。
    $req = new EditPasswordsRequest();
    $req->TimeStamp = time();
    // 需要设备开启注册
    $req->Session = 'fdjlsfjeowjfldsfa';

    $passwordInfo = new PasswordInfo();
    $passwordInfo->PasswordId = "Password1";
    $passwordInfo->PasswordType = 1;
    $passwordInfo->EncryptType = 0;
    $passwordInfo->Password = "123456";
    $passwordInfo->UnitId = "";
    $passwordInfo->RoomId = "";
    $passwordInfo->UserName = "";
    $passwordInfo->TempUserName = "";
    $passwordInfo->GuestType = 1;
    $passwordInfo->ValidCount = 1;
    $passwordInfo->SaveTime = date('Y-m-d H:m:s', time());
    $passwordInfo->StartTime = "2021-03-01 00:00:00";
    $passwordInfo->EndTime = "2021-04-01 00:00:00";

    $req->List = [$passwordInfo];

    // 通过client对象调用 passwordList 方法发起请求。注意请求方法名与请求对象是对应的
    // 返回的resp是一个 PasswordListResponse 类的实例，与请求对象对应
    $resp = $client->passwordList($req);

    var_dump($resp);

    // 输出json格式的字符串回包
    print_r($resp->toJsonString());

    // 也可以取出单个值。
    // 你可以通过官网接口文档或跳转到response对象的定义处查看返回字段的定义
    print_r($resp->getName());
} catch (DeviceSDKException $e) {
    echo $e;
}