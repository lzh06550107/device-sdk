<?php

use JuLongDeviceHttp\Common\Exception\DeviceSDKException;
use JuLongDeviceHttp\Common\Profile\ClientProfile;
use JuLongDeviceHttp\Common\Profile\HttpProfile;
use JuLongDeviceHttp\ParamSetting\Models\CaptureModeParam;
use JuLongDeviceHttp\ParamSetting\Models\FaceParameters;
use JuLongDeviceHttp\ParamSetting\Models\SetFaceParametersRequest;
use JuLongDeviceHttp\ParamSetting\Models\TimeTable;
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
    $req = new SetFaceParametersRequest();
    $req->TimeStamp = time();
    // 需要设备开启注册
    $req->Session = 'fdjlsfjeowjfldsfa';

    $faceParameters = new FaceParameters();
    $faceParameters->FaceEnabled = 1;
    $faceParameters->Sensitivity = 9;
    $faceParameters->CaptureMode = 4;

    $captureModeParam = new CaptureModeParam();
    $captureModeParam->CaptureTimes = 1;
    $captureModeParam->CaptureInterval = 1;
    $faceParameters->CaptureModeParam = $captureModeParam;

    $faceParameters->MaxFaceSize = 500;
    $faceParameters->MinFaceSize = 150;
    $faceParameters->MinTemperatureSize = 250;
    $faceParameters->SceneMode = 1;
    $faceParameters->FaceTrackEnabled = 1;
    $faceParameters->FTPUploadEnabled = 1;
    $faceParameters->PictureMode = 0;
    $faceParameters->FacePictureQuality = 99;
    $faceParameters->ScenePictureQuality = 99;
    $faceParameters->FaceAttributeEnabled = 1;
    $faceParameters->LivenessEnabled = 1;
    $faceParameters->Priority = 0;
    $faceParameters->Compression = 0;

    $timeTable1 = new TimeTable();
    $timeTable1->TimeEnabled = 1;
    $timeTable1->TimeBegin = "01:11:59";
    $timeTable1->TimeEnd = "12:19:59";

    $timeTable2 = new TimeTable();
    $timeTable2->TimeEnabled = 1;
    $timeTable2->TimeBegin = "02:11:59";
    $timeTable2->TimeEnd = "14:19:59";

    $faceParameters->TimeTable = [$timeTable1, $timeTable2];

    $req->Data = $faceParameters;
    // 通过client对象调用 setFaceParameters 方法发起请求。注意请求方法名与请求对象是对应的
    // 返回的resp是一个 setFaceParametersResponse 类的实例，与请求对象对应
    $resp = $client->setFaceParameters($req);

    var_dump($resp);

    // 输出json格式的字符串回包
    print_r($resp->toJsonString());

    // 也可以取出单个值。
    // 你可以通过官网接口文档或跳转到response对象的定义处查看返回字段的定义
    print_r($resp->getName());
} catch (DeviceSDKException $e) {
    echo $e;
}