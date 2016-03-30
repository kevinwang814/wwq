<?php

$apiData = array(
    'status' => 'failure',
);

$validator = new Ext_Form_Validate($_POST);
$validator->first_error_only();
$validator->addrule('mobile_num', '手机号不能为空', 'not_empty');
$validator->addrule('mobile_num', '不是正确的手机号', 'is_mobile');
$validator->addrule('mobile_num', '手机号未注册', 'exist', array('b_admin', 'mobile_num'));
if (!$validator->is_valid()) {
    $errors = $validator->errorMessage();
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            $apiData['message'] = $error[0];
            Ext_Misc::api_output($apiData);
        }
    }
}

$mobile_num = postv('mobile_num');
$captcha = rand(100000, 999999);
$message = "管理后台登录验证码：{$captcha}";

if (importHelper('sms')->send($mobile_num, $message)) {
    $_SESSION['admin'] = array(
        'captcha' => $captcha,
    );
    $apiData['status'] = 'success';
} else {
    $apiData['message'] = '发送验证码失败';
}
Ext_Misc::api_output($apiData);
