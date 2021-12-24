# 设备sdk
对应 http-20210908 协议版本。

# 演示配置
需要设置 demo/server/ 为本地服务根目录。

index文件会处理设备发送过来的注册、心跳、抓拍请求。

# 完成的接口

- JVTPlatformReq：激活设备；
    ```php
  <?php
  
  use JuLongDevice\Basic\BasicClient;
  use JuLongDevice\Basic\Models\JVTPlatformReq;
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
      // 这里使用md5签名验证
  //    $clientProfile->setSignMethod(ClientProfile::$SIGN_MD5);  // 指定签名算法(默认为md5)
  //    $clientProfile->setUUID("umethqdt2gm9");
  //    $clientProfile->setDeviceAdmin("admin");
  //    $clientProfile->setDevicePassword("admin");
      $clientProfile->setHttpProfile($httpProfile);
  
      // 实例化要请求client对象,clientProfile是可选的
      $client = new BasicClient($clientProfile);
  
      // 实例化一个cvm实例信息查询请求对象,每个接口都会对应一个request对象。
      $req = new JVTPlatformRequest();
  
      // 填充请求参数,这里request对象的成员变量即对应接口的入参
      $jVTPlatformReq = new JVTPlatformReq();
      $jVTPlatformReq->DomainName = "http://128.128.20.81";
      $jVTPlatformReq->Port = 80;
      $jVTPlatformReq->RegisterPath = "index.php?op=register";
      $jVTPlatformReq->HeartbeatPath = "index.php?op=online";
      $jVTPlatformReq->CaptureInfoPath = "index.php?op=compareinfo";
      $jVTPlatformReq->DeviceSN = "123456789";
      $jVTPlatformReq->DeviceAdmin = "admin";
      $jVTPlatformReq->DevicePassword = "admin";
      $jVTPlatformReq->MiddleWareAddress = "http://128.128.20.81";
  
      $req->Data = $jVTPlatformReq;
  
      // 通过client对象调用 JVTPlatformReq 方法发起请求。注意请求方法名与请求对象是对应的
      // 返回的resp是一个 JVTPlatformReqResponse 类的实例，与请求对象对应
      $resp = $client->JVTPlatformReq($req);
  
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
  
      // 实例化一个cvm实例信息查询请求对象,每个接口都会对应一个request对象。
      $req = new EventNotifyRequest();
      $req->Name = 'eventNotifyRequest';
      $req->TimeStamp = time();
      // 需要设备开启注册
      $req->Session = 'fdjlsfjeowjfldsfa';
  
  
      // 通过client对象调用 EventNotifyRequest 方法发起请求。注意请求方法名与请求对象是对应的
      // 返回的resp是一个 EventNotifyResponse 类的实例，与请求对象对应
      $resp = $client->EventNotifyRequest($req);
  
      var_dump($resp);
  
      // 输出json格式的字符串回包
      print_r($resp->toJsonString());
  
      // 也可以取出单个值。
      // 你可以通过官网接口文档或跳转到response对象的定义处查看返回字段的定义
      print_r($resp->Name);
  }catch (DeviceSDKException $e) {
      echo $e;
  }
  ```

## 注意

- composer require guzzlehttp/guzzle 兼容tp/laveral
- composer require yurunsoft/guzzle-swoole 兼容基于swoole的框架