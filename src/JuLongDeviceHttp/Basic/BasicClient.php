<?php

namespace JuLongDeviceHttp\Basic;

use JuLongDeviceHttp\Common\AbstractClient;
use JuLongDeviceHttp\Common\Exception\DeviceSDKException;
use JuLongDeviceHttp\Common\Profile\ClientProfile;

/**
 * 设备基础操作
 * Created on 2021/12/23 10:54
 * Create by LZH
 *
 * @method Models\JVTPlatformResponse JVTPlatform(Models\JVTPlatformRequest $req) 本接口用于激活设备。
 * @method Models\EventNotifyResponse eventNotify(Models\EventNotifyRequest $req) 主动获取任务请求。
 * @method Models\DeviceInfoResponse deviceInfo(Models\DeviceInfoRequest $req) 主动获取任务请求。
 * @method Models\IOControlResponse IOControl(Models\IOControlRequest $req) IO控制（远程开门）。
 * @method Models\TimeSynchronizationResponse timeSynchronization(Models\TimeSynchronizationRequest $req) 时间同步。
 * @method Models\RestartResponse restart(Models\RestartRequest $req) 设备重启。
 * @method Models\RestartTimeResponse restartTime(Models\RestartTimeRequest $req) 设备定时重启。
 * @method Models\RestoreFactoryResponse restoreFactory(Models\RestoreFactoryRequest $req) 恢复出厂设置。
 * @method Models\UpgradeDeviceResponse upgradeDevice(Models\UpgradeDeviceRequest $req) 恢复出厂设置。
 * @method Models\ActiveCaptureResponse ActiveCapture(Models\ActiveCaptureRequest $req) 主动抓拍。
 */
class BasicClient extends AbstractClient
{
    /**
     * @var string
     */
    protected $service = "basic";

    /**
     * @var string
     */
    protected $version = "2021-12-23";

    /**
     * @param ClientProfile|null $profile
     * @throws DeviceSDKException
     */
    function __construct($profile=null)
    {
        parent::__construct($profile);
    }

    public function returnResponse($action, $response)
    {
        $respClass = "JuLongDeviceHttp"."\\".ucfirst($this->service)."\\"."Models"."\\".ucfirst($action)."Response";
        $obj = new $respClass();
        $obj->deserialize($response);
        return $obj;
    }
}