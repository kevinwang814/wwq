<?php
$view = Core_View::getInstance();
if ($_POST) {
    //数据库验证数据
    $option = array(
        'name' => postv_t('name'),
    );
    $admin = importModel('Admin')->getBy($option);
    if($admin['password'] == md5(postv_t('password'))){
        //存入数据到session中
        $_SESSION['admin'] = array(
            'id' => $admin['id'],
            'name' => $admin['name'],
        );
        R('/');
    }else{
        $errorMessage = '用户名或密码不正确';
        $view->assign('errorMessage', $errorMessage);
    }
}
$view->display('admin/login');
