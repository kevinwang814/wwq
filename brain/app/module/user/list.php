<?php
    //获取用户列表
    $page = getv_t('page',1);
    $page_size = 10;
    $offset = ($page-1)*$page_size;
    $option = array(
        'offset' => $offset,
        'limit' => $page_size,
        'orderby' => 'update_time DESC',
        'condition' => array(
            'status' => 'enabled',
        ),
    );
    $requestData = array(
        
    );
    $userList = importModel('User')->getList($option);
    if($userList){
        foreach ($userList as & $userInfo){
            $userInfo['update_time'] = date('Y-m-d H:i:s',$userInfo['update_time']);
        }
    }
    $view = Core_View::getInstance();
    $view->assign('userList',$userList);
    $view->display('user/list');