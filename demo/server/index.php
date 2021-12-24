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
    case 'compareinfo':
        $result = compareinfo($actData);
        break;
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
function compareinfo($actData)
{
    if ($actData['Name'] == 'captureInfoRequest') {

        //定义返回的数据
        $retArray['Name'] = 'captureInfoResponse';
        $retArray['TimeStamp'] = time();
        $retArray['Code'] = 1;
        $retArray['Message'] = 'ok';

        $retArray['Session'] = 'fdjlsfjeowjfldsfa'; // 设置响应包中session

        return $retArray;
    }
}