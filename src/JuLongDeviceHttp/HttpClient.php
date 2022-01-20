<?php

declare(strict_types=1);

namespace JuLongDeviceHttp;

use JuLongDeviceHttp\AccessControlPassword\AccessControlPasswordClient;
use JuLongDeviceHttp\AccessStrategy\AccessStrategyClient;
use JuLongDeviceHttp\Basic\BasicClient;
use JuLongDeviceHttp\FaceCompare\FaceCompareClient;
use JuLongDeviceHttp\FaceManage\FaceManageClient;
use JuLongDeviceHttp\HealthCode\HealthCodeClient;
use JuLongDeviceHttp\NVRManage\NVRManageClient;
use JuLongDeviceHttp\ParamSetting\ParamSettingClient;

/**
 * 请求设备接口类
 * Created on 2021/12/23 10:24
 * Create by LZH
 *
 * @method static BasicClient basicClient() 基础操作接口客户端
 * @method static AccessControlPasswordClient accessControlPasswordClient() 管理门禁密码接口客户端
 * @method static AccessStrategyClient accessStrategyClient() 通行策略管理接口客户端
 * @method static FaceCompareClient faceCompareClient() 人脸比对功能接口客户端
 * @method static FaceManageClient faceManageClient() 管理名单库接口客户端
 * @method static HealthCodeClient healthCodeClient() 健康码信息接口客户端
 * @method static NVRManageClient NVRManageClient() NVR管理接口客户端
 * @method static ParamSettingClient paramSettingClient() 参数获取和设置接口客户端
 *
 */
class HttpClient
{
    /**
     * @var string[] 已经实现的客户端类
     */
    private static $method = [
        'BaseClient',
        'AccessControlPasswordClient',
        'AccessStrategyClient',
        'FaceCompareClient',
        'FaceManageClient',
        'HealthCodeClient',
        'NVRManageClient',
        'ParamSettingClient'
    ];

    /**
     * @var HttpClientBuilder
     */
    private static $httpClientBuilder;

    public static function configurator(): HttpClientBuilder
    {
		return self::$httpClientBuilder = new HttpClientBuilder();
	}

    /**
     * @throws \Exception
     */
    public static function __callStatic($name, $arguments) {

        if (in_array(strtoupper($name), self::$method)) {
            call_user_func_array([self::$httpClientBuilder,'get'. strtoupper($name)],$arguments);
        } else {
            throw new \Exception('方法不存在');
        }

    }
}