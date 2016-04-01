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
    $option2 = array(
        'condition' => 'status = "enabled"'
    );
    $requestData = array(
        
    );
    $userList = importModel('User')->getList($option);
    $userCount = importModel('User')->getCount($option2);
    if($userList){
        foreach ($userList as & $userInfo){
            $userInfo['update_time'] = date('Y-m-d H:i:s',$userInfo['update_time']);
        }
    }
    $pager = new Ext_Pager($page,$userCount,U('user/list'),$page_size);
    $view = Core_View::getInstance();
    $view->assign('pager', $pager->show(3));
    $view->assign('page', $page);
    $view->assign('page_size', $page_size);
    $view->assign('userCount', $userCount);
    $view->assign('userList',$userList);
    $view->display('user/list');