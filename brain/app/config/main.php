<?php

return array(
    #数据库配置信息
    'db' => array(
       'default' => array(
            'host' => '127.0.0.1', #服务器地址
            'user' => 'root', #数据库用户名
            'password' => '', #密码
            'dbname' => 'wwq', #数据库
        ),
    ),
    
    'redis'=>array(
        'redis_host'=>'10.10.100.68',
        'redis_port'=>'6379',
        'redis_auth'=>'n48*vcbk2#7c%3vkb90kx!ck'
    ),
    
    #调试配置信息
    'debug' => true, #调试模式，默认开启
    'show_errors' => true, #是否显示系统错误信息，true显示，false不显示。
    'misc_compress' => false,
    'tpl_404' => '404.tpl.php',
    'url_rewrite'   =>  false,
    'tpl_success'   =>  'success.tpl.php',
    'tpl_error'   =>  'error.tpl.php',
    
    'log_level' => LOG_DEBUG,   # Syslog 日志级别，可选 LOG_ERR, LOG_WARNING, LOG_INFO, LOG_DEBUG
    'log_path' => array(
        'db'=> '/data/weblog/php/wwq_db.log'
        ),
    'log_traceback' => true,    # 是否在日志中记录调用栈
    'log_process_id' => true,   # 是否在日志中记录唯一的请求编号
    
    'img_dir' => '/data/wwq/image',
    
    'img_host' => '127.0.0.1:9983',
    /**
     * 服务器编号，只能取 0~9，用于在同多服务器上产生唯一的 show_order_id 或其他类似的字段值
     */
    'host_id' => '1',

);