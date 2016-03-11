<?php
/**
 * 加载配置文件
 */
function loadConfigFile($path)
{
    if(isset($GLOBALS['__IncludePath'][$path]) || !is_file($path))
        return false;
    
    $config = include $path;
    
    $GLOBALS['__IncludePath'][$path] = true;
    if(isset($GLOBALS['__Config']) && is_array($GLOBALS['__Config']))
    {
        $GLOBALS['__Config'] = array_merge($GLOBALS['__Config'], $config);

    }
    else
    {
        $GLOBALS['__Config'] = $config;
    }
}

/**
 * 获取配置信息
 */
function C($name)
{
    $arry_key = explode('.', $name);

    $config = $GLOBALS['__Config'];
    foreach($arry_key as $cur_key)
    {
        if(isset($config[$cur_key]))
        {
            $config = $config[$cur_key];
        }
        else
        {
            return null;
        }
    }
    return $config;
}

/**
 * 根据class名获取class文件路径
 */
function getClassFilePath($className)
{
    $subPath = str_replace('_', '/', $className);
    $loadDir = array(COMMON_PATH, APP_PATH, FW_PATH, __DIR__);
    foreach($loadDir as $dir)
    {
        $filePath = "{$dir}/{$subPath}.class.php";

        if(is_file($filePath) && is_readable($filePath))
        {
            return $filePath;
        }
        
        $filePath = "{$dir}/{$subPath}.php";
        if(is_file($filePath) && is_readable($filePath))
        {
            return $filePath;
        }
    }
    return false;
}
/**
 * 定义autoload方法
 */
function autoload($className)
{
    $className = strtolower($className);
    $filePath = getClassFilePath($className);
    
    if ($filePath) {
        include $filePath;
    }
    else {
        LOGD($className. '没有定义,类文件' . $filePath . '不存在！');
    }
    //else if(!C('debug')) show_404();
    //else show_error($className. '没有定义,类文件' . $filePath . '不存在！');
    
}

/**
 * 注册autoload
 */
function registerAutoload()
{
    if(!function_exists('spl_autoload_register'))
    {
        show_error('spl_autoload does not exist in this PHP installation');
    }
    spl_autoload_register('autoload');
}

/**
 * error处理方法
 */
function error_handler($errno, $errstr, $errfile, $errline)
{
    if(!C('show_errors'))
        return true;
    throw new Core_Exception($errstr, $errno, array('errfile' => $errfile, 'errline' => $errline));
    //$errorStr = "[$errno] $errstr ".basename($errfile)." line $errline";
    //echo $errorStr;
}

/**
 * 异常处理方法
 */
function exception_handler($ex)
{
    echo $ex;
}

/**
 * 显示404页面
 */
function show_404()
{
    if(C('tpl_404')) include APP_PATH . '/view/_public/' . C('tpl_404');
    else include FW_PATH . '/tpl/404.tpl.php';
    exit;
}

/**
 * 自定义消息的错误页面
 */
function show_error($message, $url='', $wait=6)
{
    if(C('tpl_error')) include APP_PATH . '/view/_public/' . C('tpl_error');
    else include FW_PATH . '/tpl/500.tpl.php';
    exit;
}

/**
 * 成功页面
 */
function show_success($message, $url='', $wait=6,$is_exit = true)
{
    if($url === '' && isset($_SERVER['HTTP_REFERER'])) $url = $_SERVER['HTTP_REFERER'];
    if(C('tpl_success')) include APP_PATH . '/view/_public/' . C('tpl_success');  
    else include FW_PATH . '/tpl/success.tpl.php';
    
    
    if ($is_exit) {
        exit;
    }
}

/*
 * 初始化框架
 */
function init()
{  
    define('COMMON_PATH', '../common');
    ini_set("magic_quotes_runtime", 0);
    mb_internal_encoding("UTF-8");
    date_default_timezone_set('PRC');
    registerAutoload();
    loadConfigFile(APP_PATH.'/config/main.php');
    loadConfigFile(FW_PATH.'/config/global.php');
    #set_error_handler("error_handler");
    #set_exception_handler('exception_handler');

    if (isset($_POST['PHPSESSID'])) {
	Session_id($_POST['PHPSESSID']);
    }

    session_start();
}

function importModel($name)
{
    $name = "Model_{$name}";
    if(isset($GLOBALS['__ModelCache'][$name])) 
        return $GLOBALS['__ModelCache'][$name];
        
    $model = new $name();
    $GLOBALS['__ModelCache'][$name] = $model;

    return $model;
}

function importExtend($name)
{
    $name = "Extend_{$name}";
    if(isset($GLOBALS['__ExtendCache'][$name]))
        return $GLOBALS['__ExtendCache'][$name];

    $extend = new $name();
    $GLOBALS['__ExtendCache'][$name] = $extend;

    return $extend;
}

function importCache($name)
{
    $name = "Cache_{$name}";
    if(isset($GLOBALS['__CacheCache'][$name]))
        return $GLOBALS['__CacheCache'][$name];

    $cache = new $name();
    $GLOBALS['__CacheCache'][$name] = $cache;

    return $cache;
}

function importHelper($name)
{
    $name = "Helper_{$name}";
    if(isset($GLOBALS['__HelperCache'][$name]))
        return $GLOBALS['__HelperCache'][$name];

    $cache = new $name();
    $GLOBALS['__HelperCache'][$name] = $cache;

    return $cache;
}

function dump($vars, $label = '', $return = false)
{
    @header('Content-type:text/html;charset=utf8');
    $content = "<pre>\n";
    if($label != '')
    {
        $content .= "<strong>{$label} :</strong>\n";
    }
    
    $content .= htmlspecialchars(print_r($vars, true));
    $content .= "\n</pre>\n";
    
    if($return)
    {
        return $content;
    }
    echo $content;
}

/* 过滤危险HTML */
function h($str)
{
    return htmlspecialchars($str);
}

/** 直接输出转义后的 HTML */
function HO($str) {
    echo htmlspecialchars($str);
}

function de_h($text)
{
    return htmlspecialchars_decode($text);
}

function h_safe($str)
{
    return htmlentities($str, ENT_QUOTES, 'UTF-8');
}

/**
 * 获取$_GET中的值
 */
function getv($key, $default='')
{
    return isset($_GET[$key]) && $_GET[$key] != '' ? $_GET[$key] : $default;
}

/**
 * 获取$_GET中的值，并执行trim
 */
function getv_t($key, $default='')
{
    return isset($_GET[$key]) && $_GET[$key] != '' ? trim($_GET[$key]) : $default;
}

/**
 * 获取$_POST中的值
 */
function postv($key, $default='')
{
    return isset($_POST[$key]) && $_POST[$key] != '' ? $_POST[$key] : $default;
}

/**
 * 获取$_POST中的值，并执行trim
 */
function postv_t($key, $default='')
{
    return isset($_POST[$key]) && $_POST[$key] != '' ? trim($_POST[$key]) : $default;
}

/**
 * 获取$_REQUEST中的值
 */
function requestv($key, $default='')
{
    return isset($_REQUEST[$key]) && $_REQUEST[$key] != '' ? $_REQUEST[$key] : $default;
}

/**
 * 获取$_REQUEST中的值，并执行trim
 */
function requestv_t($key, $default='')
{
    return isset($_REQUEST[$key]) && $_REQUEST[$key] != '' ? trim($_REQUEST[$key]) : $default;
}

/**
 * 获取$_COOKIE中的值
 */
function cookiev($key, $default = '')
{
    return isset($_COOKIE[$key]) && $_COOKIE[$key] != '' ? $_COOKIE[$key] : $default;
}

/**
 * 获取$_global中的值
 */
function globalv($key, $default = '')
{
    $arry_key = explode('.', $key);
    $global = $GLOBALS;
    foreach($arry_key as $cur_key)
    {
        if(isset($global[$cur_key]))
        {
            $global = $global[$cur_key];
        }
        else
        {
            return $default;
        }
    }
    return $global;
}

/**
 * 获取$_SESSION中的值
 */
function sessionv($key, $default = '')
{
    $arry_key = explode('.', $key);
    $session = $_SESSION;
    foreach($arry_key as $cur_key)
    {
        if(isset($session[$cur_key]))
        {
            $session = $session[$cur_key];
        }
        else
        {
            return $default;
        }
    }
    return $session;
}

function R($url, $wait=0, $message='')
{
    if(!headers_sent())
    {
        header("Content-Type:text/html; charset=UTF-8");
        //header("Location: {$url}");
        echo "<script>";
        echo "window.location='{$url}';";
        echo "</script>";
    }
    else
    {
        //include FW_PATH.'/tpl/301.tpl.html';
        echo "<script>";
        echo "window.location='{$url}';";
        echo "</script>";
    }
}

/*检查MOD的第一个单词*/
function mod_nav($check) {
    $mods = getv('mod');
    $modlist = explode('.',$mods);
    
    if ($modlist['0'] == $check) {
        return true;
    } 
    return false;
}

/**
 * URL装配车间,生成url，
 * 例子:U('index/help', array('id'=>25)) 或 U('index/help','id/15');
 * 那么可能生成：http://host/project/index.php/index/help/id/25.html
 *
 * @param string $base 控制器和方法
 * @param array  $param_arr url其他参数,接受参数array或string
 * @return string url 生成后的url字符串
 */
function U($base, $param_arr = array()) {
    $baseSiteUrl = "";
    $url = array();
    if (count($param_arr) > 0) {
        foreach ($param_arr as $key => $value) {
            if($value){
                $url[] = $key . '=' . $value;
            }
        }
        if(isset($url) && !empty($url)){
            return $baseSiteUrl . '/' . $base . '.html?' . implode('&', $url);
        }
    }
    return $baseSiteUrl . '/' . $base . '.html';
}

//获取当前登录用户user_id
function getCurrentUserId()
{
    $user_id = isset($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : '';
    return $user_id;
}

// 打印日志到指定的文件中
function LOGS($log, $path_index='default') {
    if (C('log_traceback') == true) {
        $bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $bt = array_slice($bt, 1);
        
        $log = '> ' . $log;
        
        foreach ($bt as $v) {
            $log = "(" . basename(@$v['file']) . ":" . @$v['line'] . ")" . @$v['function'] . "-${log}";
        }
    }
    
    $mod = getv('mod', '');
    if(!$mod){
        return FALSE;
    }
    
    $path = C('log_path');
    
    $log_path = isset($path[$path_index]) ? $path[$path_index] : '';
    
    if (!$log_path) {
        return FALSE;
    }
        
    /// 附加请求编号
    static $pid = 0;
    if (C('log_process_id') == true) {
        if ($pid == 0) {
            $pid = rand();
        }
        
        $log = "(${pid})"  . $log;
    }
       
    /// 附加日期
    $log = '[' . date(DATE_RFC822) . ']' . $log . "\n";
    
    file_put_contents($log_path, $log, FILE_APPEND);
}

/// 打印 Warning 级别的日志到 Syslog
function LOGW($log, $path_index='default') {
    if (C('log_level') &&  LOG_WARNING <= C('log_level')) {
        LOGS($log, $path_index);
    }
}

/// 打印 Error 级别的日志到 Syslog
function LOGE($log, $path_index='default') {
    if (C('log_level') && LOG_ERR <= C('log_level')) {
        LOGS($log, $path_index);
    }
}

/// 打印 Info 级别的日志到 Syslog
function LOGI($log, $path_index='default') {
    if (C('log_level') && LOG_INFO <= C('log_level')) {
        LOGS($log, $path_index);
    }
}

/// 打印 DEBUG 级别的日志到 Syslog
function LOGD($log, $path_index='default') {
    if (C('log_level') && LOG_DEBUG <= C('log_level')) {
        LOGS($log, $path_index);
    }
    
}

init();
?>