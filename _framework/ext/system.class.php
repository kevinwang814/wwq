<?php
class Ext_System
{
    public static function getOS() {
        $Agent = $_SERVER["HTTP_USER_AGENT"];
        $os = '';
        if (strpos($Agent,"win")) {
            $os="Windows";
        }
        elseif (strpos($Agent,'linux')) {
            $os="Linux";
        }
        elseif (strpos($Agent,'unix')) {
            $os="Unix";
        }
        elseif (strpos($Agent,'iPad')) {
            $os="iPad";
        }
        elseif (strpos($Agent,'iPhone')) {
            $os="iPhone";
        }elseif (strpos($Agent,'Android')) {
            $os="Android";
        }
        elseif (strpos($Agent,'Mac')) {
            $os="Macintosh";
        }
        
        if ($os=='') {
            $os = "Unknown";
            
        }
        return $os;
    }
    
    public static function getBrowser() {
        $browser_text = ' '.$_SERVER["HTTP_USER_AGENT"];
        if(strpos($browser_text,"Maxthon")){
            $browser= 'maxthon';
        }elseif(strpos($browser_text,"baidubrowser")){
            $browser= 'baidu';
        }elseif(strpos($browser_text,"QQBrowser")){
            $browser= 'qq';
        }elseif(strpos($browser_text,"360SE")){
            $browser= '360';
        }elseif(strpos($browser_text,"SE")){
            $browser= 'sogou';
        }elseif(strpos($browser_text,"Chrome")){
            $browser= 'chrome';
        }elseif(strpos($browser_text,"Firefox")){
            $browser= 'firefox';
        }elseif(strpos($browser_text,"Safari")){
            $browser= 'safari';
        }elseif(strpos($browser_text,"Opera")){
            $browser= 'opera';
        }elseif(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 9.0")){
            $browser= 'ie9';
        }elseif(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 8.0")){
            $browser= 'ie8';
        }elseif(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 7.0")){
            $browser= 'ie7';
        }elseif(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 6.0")){
            $browser= 'ie6';
        }

        return $browser;
    }
    
    public static function getIP() {
        if (array_key_exists('REMOTE_ADDR', $_SERVER)) {
            return $_SERVER['REMOTE_ADDR'];
        }
        else {
            return '0.0.0.0';
        }
    }
    
    
    
}
?>
