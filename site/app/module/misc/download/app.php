<?php
if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')){
    $view = Core_View::getInstance();
    $view->display('misc/download/wx');
    exit;
}

$deviceType = 'other';
$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
if(strpos($agent, 'iphone') || strpos($agent, 'ipad')){
    $deviceType = 'ios';
}
if(strpos($agent, 'android')){
    $deviceType = 'android';
}

if($deviceType == 'ios'){
    /*$view = Core_View::getInstance();
    $view->display('misc/download/ios');
    exit;*/
    header('Location: https://itunes.apple.com/cn/app/sui-fen-qi/id1068066981?mt=8');
}
else{
    header('Location: http://common.suifenqi.cn/download/app/suifenqi_latest.apk');
}