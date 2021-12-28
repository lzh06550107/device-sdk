# 设备sdk
对应 http-20211223 协议版本。

# 演示配置
需要设置 demo/server/ 为本地服务根目录。

index文件会处理设备发送过来的注册、心跳、抓拍请求。

# 完成的接口

## 设备接收请求
- JVTPlatformReq：激活设备；
    ```php
  <?php
  
  use JuLongDevice\Basic\BasicClient;
  use JuLongDevice\Basic\Models\JVTPlatform;
  use JuLongDevice\Basic\Models\JVTPlatformRequest;
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
      $client = new BasicClient($clientProfile);
  
      // 实例化一个请求对象,每个接口都会对应一个request对象。
      $req = new JVTPlatformRequest();
  
      // 填充请求参数,这里request对象的成员变量即对应接口的入参
      $jVTPlatformReq = new JVTPlatform();
      $jVTPlatformReq->DomainName = "http://128.128.20.81"; // 如果是本地平台，这里是平台所在服务器地址；如果是云端平台，这里是中间件所在云服务器地址
      $jVTPlatformReq->Port = 80; // 注意端口也要修改
      $jVTPlatformReq->RegisterPath = "index.php?op=register";
      $jVTPlatformReq->HeartbeatPath = "index.php?op=online";
      $jVTPlatformReq->CaptureInfoPath = "index.php?op=compareinfo";
      $jVTPlatformReq->DeviceSN = "123456789";
      $jVTPlatformReq->DeviceAdmin = "admin";
      $jVTPlatformReq->DevicePassword = "admin";
      $jVTPlatformReq->MiddleWareAddress = "http://128.128.20.81";
  
      $req->Data = $jVTPlatformReq;
  
      // 通过client对象调用 JVTPlatform 方法发起请求。注意请求方法名与请求对象是对应的
      // 返回的resp是一个 JVTPlatformResponse 类的实例，与请求对象对应
      $resp = $client->JVTPlatform($req);
  
      var_dump($resp);
  
      // 输出json格式的字符串回包
      print_r($resp->toJsonString());
  
      // 也可以取出单个值。
      // 你可以通过官网接口文档或跳转到response对象的定义处查看返回字段的定义
      print_r($resp->Name);
  } catch(DeviceSDKException $e) {
      echo $e;
  }
    ```
- eventNotifyRequest：主动获取任务请求
  ```php
  <?php
  
  use JuLongDevice\Basic\BasicClient;
  use JuLongDevice\Basic\Models\EventNotifyRequest;
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
      $client = new BasicClient($clientProfile);
  
      // 实例化一个请求对象,每个接口都会对应一个request对象。
      $req = new EventNotifyRequest();
      $req->TimeStamp = time();
      // 需要设备开启注册
      $req->Session = 'fdjlsfjeowjfldsfa';
  
  
      // 通过client对象调用 eventNotify 方法发起请求。注意请求方法名与请求对象是对应的
      // 返回的resp是一个 eventNotifyResponse 类的实例，与请求对象对应
      $resp = $client->eventNotify($req);
  
      var_dump($resp);
  
      // 输出json格式的字符串回包
      print_r($resp->toJsonString());
  
      // 也可以取出单个值。
      // 你可以通过官网接口文档或跳转到response对象的定义处查看返回字段的定义
      print_r($resp->getName());
  }catch (DeviceSDKException $e) {
      echo $e;
  }
  ```
- deviceInfoRequest：获取设备信息
- IOControlRequest：IO控制（远程开门）
- timeSynchronizationRequest：时间同步
- restartRequest：重启设备
- restartTimeRequest：定时重启
- restoreFactoryRequest：恢复出厂
- upgradeDeviceRequest：升级设备
- activeCaptureRequest：主动抓拍

### 云台控制

### 参数获取和设置接口

- getHTTPParametersRequest：HTTP参数获取
- setHTTPParametersRequest：HTTP参数设置
- getFaceParametersRequest：人脸识别参数获取
- setFaceParametersRequest：设置人脸识别参数
- getFaceAlarmParametersRequest：人脸识别报警参数获取
- setFaceAlarmParametersRequest：人脸识别报警参数设置
- getNetParametersRequest：网络参数获取
- setNetParametersRequest：网络参数设置
- getTimeParametersRequest：时间参数获取(NTP)
- getTimeParametersRequest：时间参数设置(NTP)
- getAudioParametersRequest：音频参数获取
- setAudioParametersRequest：音频参数设置
- getMQTTParametersRequest：MQTT参数获取
- setMQTTParametersRequest：MQTT参数设置
- getSIMCardRequest：SIM卡(4G/5G)参数获取
- setSIMCardRequest：SIM卡(4G/5G)参数设置
- setUserPasswordRequest：用户名密码设置
- getGPSParametersRequest：GPS信息参数获取
- setGPSParametersRequest：GPS参数设置



## 注意

- composer require guzzlehttp/guzzle 兼容tp/laveral
- composer require yurunsoft/guzzle-swoole 兼容基于swoole的框架