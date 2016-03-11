<?php
    //状态初始化
    $dealStatus = array(
        'status' => 'failure',
    );
    //处理添加用户表单
    $username = $_POST['userName'];
    $password = md5($_POST['password']);
    $mobile_num = $_POST['mobileNum'];
    $email = $_POST['email'];
    $time = time();
    $fieldData = array(
        'name' => $username,
        'password' => $password,
        'mobile_num' => $mobile_num,
        'email' => $email,
        'create_time' => $time,
        'update_time' => $time,
        'status' => 'enabled'
    );
    if(importModel('User')->create($fieldData)){
        R(U('user/list'));
    }