<?php

namespace JuLongDeviceHttp\ParamSetting;

use JuLongDeviceHttp\Common\AbstractClient;
use JuLongDeviceHttp\Common\Exception\DeviceSDKException;
use JuLongDeviceHttp\Common\Profile\ClientProfile;

/**
 * 参数获取和设置
 * Created on 2021/12/27 9:06
 * Create by LZH
 *
 * @method Models\GetHTTPParametersResponse getHTTPParameters(Models\GetHTTPParametersRequest $req) 本接口用于获取Http参数设置
 * @method Models\SetHTTPParametersResponse setHTTPParameters(Models\SetHTTPParametersRequest $req) 本接口用于设置Http参数
 * @method Models\GetFaceParametersResponse getFaceParameters(Models\GetFaceParametersRequest $req) 本接口用于获取人脸识别参数
 * @method Models\SetFaceParametersResponse setFaceParameters(Models\SetFaceParametersRequest $req) 本接口用于设置人脸识别参数
 * @method Models\GetFaceAlarmParametersResponse getFaceAlarmParameters(Models\GetFaceAlarmParametersRequest $req) 本接口用于获取人脸识别报警参数
 * @method Models\SetFaceAlarmParametersResponse setFaceAlarmParameters(Models\SetFaceAlarmParametersRequest $req) 本接口用于设置人脸识别报警参数
 * @method Models\GetNetParametersResponse getNetParameters(Models\GetNetParametersRequest $req) 本接口用于获取网络参数设置
 * @method Models\SetNetParametersResponse setNetParameters(Models\SetNetParametersRequest $req) 本接口用于设置网络参数
 * @method Models\GetTimeParametersResponse getTimeParameters(Models\GetTimeParametersRequest $req) 本接口用于获取时间参数设置
 * @method Models\SetTimeParametersResponse setTimeParameters(Models\SetTimeParametersRequest $req) 本接口用于设置时间参数
 * @method Models\GetAudioParametersResponse getAudioParameters(Models\GetAudioParametersRequest $req) 本接口用于获取音频参数
 * @method Models\SetAudioParametersResponse setAudioParameters(Models\SetAudioParametersRequest $req) 本接口用于设置音频参数
 * @method Models\GetMQTTParametersResponse getMQTTParameters(Models\GetMQTTParametersRequest $req) 本接口用于获取MQTT参数
 * @method Models\SetMQTTParametersResponse setMQTTParameters(Models\SetMQTTParametersRequest $req) 本接口用于设置MQTT参数
 * @method Models\GetSIMCardResponse getSIMCard(Models\GetSIMCardRequest $req) 本接口用于获取SIM卡（4G/5G）参数
 * @method Models\SetSIMCardResponse setSIMCard(Models\SetSIMCardRequest $req) 本接口用于设置SIM卡（4G/5G）参数
 * @method Models\SetUserPasswordResponse setUserPassword(Models\SetUserPasswordRequest $req) 本接口用于设置用户密码参数
 * @method Models\GetGPSParametersResponse getGPSParameters(Models\GetGPSParametersRequest $req) 本接口用于获取GPS信息参数
 * @method Models\SetGPSParametersResponse setGPSParameters(Models\SetGPSParametersRequest $req) 本接口用于设置GPS信息参数
 */
class ParamSettingClient extends AbstractClient
{

    /**
     * @var string
     */
    protected $service = "paramSetting";

    /**
     * @var string
     */
    protected $version = "2021-09-08";

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