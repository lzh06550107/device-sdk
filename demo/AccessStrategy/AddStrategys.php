<?php

use JuLongDevice\AccessStrategy\AccessStrategyClient;
use JuLongDevice\AccessStrategy\Models\AddStrategysRequest;
use JuLongDevice\AccessStrategy\Models\HolidayInfo;
use JuLongDevice\AccessStrategy\Models\StrategyInfo;
use JuLongDevice\AccessStrategy\Models\TimePeriod;
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
    $client = new AccessStrategyClient($clientProfile);

    // 实例化一个查询请求对象,每个接口都会对应一个request对象。
    $req = new AddStrategysRequest();
    $req->TimeStamp = time();
    // 需要设备开启注册
    $req->Session = 'fdjlsfjeowjfldsfa';

    $strategyInfo = new StrategyInfo();
    $strategyInfo->StrategyId = 1;
    $strategyInfo->StrategyName = "test";
    $strategyInfo->AccessNumLimit = 1;
    $strategyInfo->AllowAccessNum = 5;
    $strategyInfo->StartTime = "2021-01-01 00:00:00";
    $strategyInfo->EndTime = "2021-12-12 23:59:59";
    $strategyInfo->Monday = [new TimePeriod("09:00:00", "14:30:00")];
    $strategyInfo->Tuesday = [new TimePeriod("09:00:00", "14:30:00")];
    $strategyInfo->Wednesday = [new TimePeriod("09:00:00", "14:30:00")];
    $strategyInfo->Thursday = [new TimePeriod("09:00:00", "14:30:00")];
    $strategyInfo->Friday = [new TimePeriod("09:00:00", "14:30:00")];
    $strategyInfo->Saturday = [new TimePeriod("09:00:00", "14:30:00")];
    $strategyInfo->Sunday = [new TimePeriod("09:00:00", "14:30:00")];
    $strategyInfo->HolidayInfo = [new HolidayInfo("2020-01-01 23:59:59", "2020-01-02 00:00:00", [new TimePeriod("15:21:00", "18:50:00")])];

    $req->StrategyList = [$strategyInfo];

    // 通过client对象调用 accessStrategy 方法发起请求。注意请求方法名与请求对象是对应的
    // 返回的resp是一个 AccessStrategyResponse 类的实例，与请求对象对应
    $resp = $client->accessStrategy($req);

    var_dump($resp);

    // 输出json格式的字符串回包
    print_r($resp->toJsonString());

    // 也可以取出单个值。
    // 你可以通过官网接口文档或跳转到response对象的定义处查看返回字段的定义
    print_r($resp->getName());
} catch (DeviceSDKException $e) {
    echo $e;
}