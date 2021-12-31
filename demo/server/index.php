<?php

$actData = json_decode(file_get_contents('php://input'), true);

$operator = $_GET['op'] ?? 'default';

$result = [];

switch ($operator) {
    case 'register':
        $result = register($actData);
        break;
    case 'online':
        $result = online($actData);
        break;
    case 'compareInfo':
        $result = compareInfo($actData);
        break;
    case 'historyRecord':
        $result = historyRecord($actData);
    default:
        echo '有请求！';
}

if (empty($result)) {
    print_r('出错了!');
}

echo json_encode($result, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);


// 注册
function register($actData) {

    if ($actData['Name'] == 'registerRequest') {

        file_put_contents(__DIR__ . "/logs/register.log", print_r($actData,true), FILE_APPEND);

        //定义返回的数据
        $retArray['Name'] = 'registerResponse';
        $retArray['TimeStamp'] = time();
        $retArray['Code'] = 1;
        $retArray['Message'] = 'ok';

        $retArray['Data']['Session'] = 'fdjlsfjeowjfldsfa'; // 设置响应包中session
        $retArray['Data']['ServerVersion'] = $actData['Data']['HTTPVersion']; // 服务器版本

        return $retArray;
    }
}

// 心跳
function online($actData) {

    if ($actData ['Name'] == 'heartbeatRequest') {

        file_put_contents(__DIR__ . "/logs/heartbeat.log", print_r($actData,true), FILE_APPEND);

        //定义返回的数据
        $retArray['Name'] = 'heartbeatResponse';
        $retArray['TimeStamp'] = time();
        $retArray['Code'] = 1;
        $retArray['Message'] = 'ok';

        $retArray['Session'] = 'fdjlsfjeowjfldsfa'; // 设置响应包中session
        $retArray['EventCount'] = 0; // =1时，设备调用“主动获取任务”接口请求任务

        return $retArray;

    }
}

// 抓拍信息上传
function compareInfo($actData)
{
    if ($actData['Name'] == 'captureInfoRequest') {

        file_put_contents(__DIR__ . "/logs/captureInfo.log", print_r($actData,true), FILE_APPEND);

        //定义返回的数据
        $retArray['Name'] = 'captureInfoResponse';
        $retArray['TimeStamp'] = time();
        $retArray['Code'] = 1;
        $retArray['Message'] = 'ok';

        $retArray['Session'] = 'fdjlsfjeowjfldsfa'; // 设置响应包中session

        return $retArray;
    }
}

// 上报历史抓拍记录
function historyRecord($actData)
{
    if ($actData['Name'] == 'recordInfoRequest') {

        file_put_contents(__DIR__ . "/logs/historyRecord.log", print_r($actData,true), FILE_APPEND);

        //定义返回的数据
        $retArray['Name'] = 'recordInfoResponse';
        $retArray['TimeStamp'] = time();
        $retArray['Code'] = 1;
        $retArray['Message'] = 'ok';

        $retArray['Session'] = 'fdjlsfjeowjfldsfa'; // 设置响应包中session

        return $retArray;
    }
}