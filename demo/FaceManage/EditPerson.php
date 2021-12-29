<?php

use JuLongDevice\Common\Exception\DeviceSDKException;
use JuLongDevice\Common\Profile\ClientProfile;
use JuLongDevice\Common\Profile\HttpProfile;
use JuLongDevice\FaceManage\FaceManageClient;
use JuLongDevice\FaceManage\Models\EditPersonRequest;
use JuLongDevice\FaceManage\Models\PersonInfo;
use JuLongDevice\FaceManage\PersonAddType;
use JuLongDevice\FaceManage\PersonIdentity;
use JuLongDevice\FaceManage\PersonType;

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
    $client = new FaceManageClient($clientProfile);

    // 实例化一个请求对象,每个接口都会对应一个request对象。
    $req = new EditPersonRequest();
    $req->TimeStamp = time();
    // 需要设备开启注册
    $req->Session = 'fdjlsfjeowjfldsfa';

    $req->AddType = PersonAddType::$IMAGE_ADD;
    $req->PersonType = PersonType::$WHITE_FACE;
    $editPersonInfo = new PersonInfo();
    $editPersonInfo->PersonId = "1";
    $editPersonInfo->PersonName = "change_test";
    $editPersonInfo->Sex = 1;
    $editPersonInfo->IDCard = "789654123963852741";
    $editPersonInfo->Nation = "汉族";
    $editPersonInfo->Birthday = "2000-12-31";
    $editPersonInfo->Phone = "15874196352";
    $editPersonInfo->Address = "广州深圳宝安街道";
    $editPersonInfo->LimitTime = 1;
    $editPersonInfo->StartTime = "2021-01-01 00:00:00";
    $editPersonInfo->EndTime = "2021-12-31 00:00:00";
    $editPersonInfo->PersonIdentity = PersonIdentity::$TEACHER;
    $editPersonInfo->Label = "测试标签";
    $editPersonInfo->ICCardNo = "789654123963852741";
    // $editPersonInfo->PersonPhoto = "";

    $req->PersonInfo = $editPersonInfo;

    // 通过client对象调用 personList 方法发起请求。注意请求方法名与请求对象是对应的
    // 返回的resp是一个 PersonListResponse 类的实例，与请求对象对应
    $resp = $client->personList($req);

    var_dump($resp);

    // 输出json格式的字符串回包
    print_r($resp->toJsonString());

    // 也可以取出单个值。
    // 你可以通过官网接口文档或跳转到response对象的定义处查看返回字段的定义
    print_r($resp->getName());
} catch (DeviceSDKException $e) {
    echo $e;
}