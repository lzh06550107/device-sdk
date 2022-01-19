<?php

use JuLongDeviceHttp\Common\Exception\DeviceSDKException;
use JuLongDeviceHttp\Common\Profile\ClientProfile;
use JuLongDeviceHttp\Common\Profile\HttpProfile;
use JuLongDeviceHttp\ParamSetting\Models\CaptureContent;
use JuLongDeviceHttp\ParamSetting\Models\HTTPParameters;
use JuLongDeviceHttp\ParamSetting\Models\PictureData;
use JuLongDeviceHttp\ParamSetting\Models\SetHTTPParametersRequest;
use JuLongDeviceHttp\ParamSetting\ParamSettingClient;

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
    $req = new SetHTTPParametersRequest();
    $req->TimeStamp = time();
    // 需要设备开启注册
    $req->Session = 'fdjlsfjeowjfldsfa';

    $httpParameters = new HTTPParameters();
    $httpParameters->CaptureEnabled = 1;
    $httpParameters->CaptureAddress = "index.php?op=compareinfo";
    $httpParameters->CaptureType = 0;

    $captureContent = new CaptureContent();
    $captureContent->FaceInfo = 1;
    $captureContent->CompareInfo = 1;
    $httpParameters->CaptureContent = $captureContent;

    $pictureData = new PictureData();
    $pictureData->BodyPicture = 1;
    $pictureData->FacePicture = 1;
    $pictureData->BackgroundPicture = 1;
    $pictureData->PersonPhoto = 1;
    $pictureData->IDCardPhoto = 1;
    $httpParameters->PictureData = $pictureData;

    $httpParameters->ResendTimes = 3;
    $httpParameters->RegisterEnabled = 1;
    $httpParameters->RegisterAddress = "index.php?op=register";
    $httpParameters->HeartbeatEnabled = 1;
    $httpParameters->HeartbeatAddress = "index.php?op=online";
    $httpParameters->HeartbeatInterval = 30;
    $httpParameters->EventAddress = "index.php?op=event";
    $httpParameters->ResultAddress = "index.php?op=result";
    $httpParameters->MiddleWareEnabled = 1;
    $httpParameters->MiddleWareAddress = "http://128.128.20.81";
    $httpParameters->Mode = 1;
    $httpParameters->VerifyAddress = "index.php?op=verify";
    $httpParameters->NoticeAddress = "index.php?op=notice";
    $httpParameters->HistoryRecordAddress = "index.php?op=record";
    $httpParameters->SignCheck = 0;
    $httpParameters->SendFirst = 1;
    $httpParameters->OfflineSend = 0;
    $httpParameters->SendTimeOut = 10;
    $httpParameters->HTTPVersion = 1;
    $httpParameters->UploadAfterPlan = 1; // TODO 这是什么东西

    $req->Data = $httpParameters;

    // 通过client对象调用 setHTTPParameters 方法发起请求。注意请求方法名与请求对象是对应的
    // 返回的resp是一个 SetHTTPParametersResponse 类的实例，与请求对象对应
    $resp = $client->setHTTPParameters($req);

    var_dump($resp);

    // 输出json格式的字符串回包
    print_r($resp->toJsonString());

    // 也可以取出单个值。
    // 你可以通过官网接口文档或跳转到response对象的定义处查看返回字段的定义
    print_r($resp->getName());
} catch (DeviceSDKException $e) {

}