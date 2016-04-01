<?php
    //状态初始化
    $dealStatus = array(
        'status' => 'failure',
    );
    //处理添加用户表单
    $requestType = postv_t('requestType','createUser');
    switch ($requestType) {
        //创建用户
        case 'createUser':
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
            break;
         
        //根据id获取新闻详情
        case 'detailUser':
            $id = postv_t('id');
            $userInfo = importExtend('User')->getInfo($id);
            //file_put_contents('/vagrant/data.log', json_encode($userInfo)."\r\n",FILE_APPEND);
            if($userInfo){
                $responseData['message'] = "success";
                $responseData['$userInfo'] = $userInfo;
                Ext_Misc::api_output($responseData);
            }else{
                Ext_Misc::api_output($responseData);
            }
            break;
            
        default:
            break;
    }
