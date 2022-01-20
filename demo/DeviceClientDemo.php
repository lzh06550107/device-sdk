<?php

use JuLongDeviceHttp\Basic\Models\JVTPlatform;
use JuLongDeviceHttp\Basic\Models\JVTPlatformRequest;
use JuLongDeviceHttp\Common\Exception\DeviceSDKException;
use JuLongDeviceHttp\Common\Profile\ClientProfile;
use JuLongDeviceHttp\Common\Profile\HttpProfile;
use JuLongDeviceHttp\HttpClient;

HttpClient::configurator()->getHttpProfile()->setProtocol(HttpProfile::$REQ_HTTP)
    ->setEndpoint("128.128.20.131:8011")->setReqMethod(HttpProfile::$REQ_POST)
    ->setReqTimeout(30)
    ->back() // 从 HttpProfile 配置回到 HttpClientBuilder 对象继续配置
    ->getClientProfile()->setSignMethod(ClientProfile::$SIGN_MD5)->setUUID("umethqdt2gm9")
    ->setDeviceAdmin('admin')->setDevicePassword('admin');

try {

    $req = new JVTPlatformRequest();

    // 填充请求参数,这里request对象的成员变量即对应接口的入参
    $jVTPlatformReq = new JVTPlatform();
    $jVTPlatformReq->DomainName = "http://128.128.20.81"; // 如果是本地平台，这里是平台所在服务器地址；如果是云端平台，这里是中间件所在云服务器地址
    $jVTPlatformReq->Port = 80; // 注意端口也要修改
    $jVTPlatformReq->RegisterPath = "index.php?op=register";
    $jVTPlatformReq->HeartbeatPath = "index.php?op=online";
    $jVTPlatformReq->CaptureInfoPath = "index.php?op=compareInfo";
    $jVTPlatformReq->DeviceSN = "123456789";
    $jVTPlatformReq->DeviceAdmin = "admin";
    $jVTPlatformReq->DevicePassword = "admin";
    $jVTPlatformReq->MiddleWareAddress = "http://128.128.20.81";

    $req->Data = $jVTPlatformReq;

    // 通过client对象调用 JVTPlatform 方法发起请求。注意请求方法名与请求对象是对应的
    // 返回的resp是一个 JVTPlatformResponse 类的实例，与请求对象对应
    $resp = HttpClient::basicClient()->JVTPlatform($req);

    var_dump($resp);

    // 输出json格式的字符串回包
    print_r($resp->toJsonString());

    // 也可以取出单个值。
    // 你可以通过官网接口文档或跳转到response对象的定义处查看返回字段的定义
    print_r($resp->Name);

} catch(DeviceSDKException $e) {
    echo $e;
}


