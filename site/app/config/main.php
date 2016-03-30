<?php

return array(
    'db' => array(
       'default' => array(
            'host' => '127.0.0.1', #服务器地址
            'user' => 'root', #数据库用户名
            'password' => '', #密码
            'dbname' => 'wwq', #数据库
        ),
    ),
    
    'debug' => true, #调试模式，默认开启
    'show_errors' => true, #是否显示系统错误信息，true显示，false不显示。
    'misc_compress' => false,
    'tpl_404' => '404.tpl.php',
    'url_rewrite'   =>  false,
    'tpl_success'   =>  'success.tpl.php',
    'tpl_error'   =>  'error.tpl.php',
);

