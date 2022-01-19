<?php

declare(strict_types=1);

namespace JuLongDeviceHttp;

use JuLongDeviceHttp\Basic\BasicClient;

/**
 * 请求设备接口类
 * Created on 2021/12/23 10:24
 * Create by LZH
 *
 * @method static BasicClient basicClient() 基础操作接口客户端
 * @method static BasicClient accessControlPasswordClient() 管理门禁密码接口客户端
 * @method static BasicClient accessStrategyClient() 通行策略管理接口客户端
 * @method static BasicClient faceCompareClient() 人脸比对功能接口客户端
 * @method static BasicClient faceManageClient() 管理名单库接口客户端
 * @method static BasicClient healthCodeClient() 健康码信息接口客户端
 * @method static BasicClient NVRManageClient() NVR管理接口客户端
 * @method static BasicClient paramSettingClient() 参数获取和设置接口客户端
 *
 */
class DeviceClient
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
     * @var DeviceClientBuilder
     */
    private static $deviceClientBuilder;

    public static function configurator(): DeviceClientBuilder
    {
		return self::$deviceClientBuilder = new DeviceClientBuilder();
	}

    /**
     * @throws \Exception
     */
    public static function __callStatic($name, $arguments) {

        if (in_array(strtoupper($name), self::$method)) {
            call_user_func_array([self::$deviceClientBuilder,'get'. strtoupper($name)],$arguments);
        } else {
            throw new \Exception('方法不存在');
        }

    }
}