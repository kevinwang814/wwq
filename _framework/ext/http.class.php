<?php
class Ext_Http
{
    /// 最后一次请求的错误号
    static public $curl_errno = 0;
    
    
    public static function clientIp()
    {
        if(getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if(getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if(getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
            $ip = getenv("REMOTE_ADDR");
        else if(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = "unknown";
        $ips = explode(',',$ip);
        
        return trim($ips[0]);
    }
    
    /**
     * 发送一个请求
     * 
     * @return mixed    当成功时，返回服务器返回的原始内容；当出错，且没有向服务器发送任何内容时，返回 FALSE；当可能已经向服务器发送了内容，但请求失败时，返回 NULL
     */
    public static function sendRequest($url, $params=array(), $method='GET', $timeout = 120 , $auth_user = NULL, $auth_pass = NULL, $contentType = 'application/x-www-form-urlencoded')
    {
        $data_string = '';
        
        if (is_array($params)) {
            $data_string = http_build_query($params);
        }
        else if (strtolower($method) == 'post') {
            $data_string = $params;
        }
        else {
            LOGW("尚不支持以任意内容作为 GET 方法的请求参数");
        }
        
        if(function_exists('curl_init'))
        {
            $ch = curl_init();
            
            if (C('socks5') != '') {
                LOGD("正在通过 " . C('socks5') . ' 代理来发出 HTTP 请求');
                curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, TRUE); 
                curl_setopt($ch, CURLOPT_PROXY, C('socks5')); 
                curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5); 
            }
            
            if($method == 'GET')
            {
                if(strpos($url, '?'))
                    $url .= '&' . $data_string;
                else
                    $url .= '?' . $data_string;
                
                curl_setopt($ch, CURLOPT_URL, $url);
            }
            else if($method == 'POST')
            {
                curl_setopt($ch, CURLOPT_URL, $url);
                if ($contentType == 'multipart/form-data') {
                    curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: multipart/form-data'));
                    
                }else if (!empty($contentType)) {
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: $contentType"));
                }
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_POST, true);
            }
            
            
            if ($auth_user !== NULL || $auth_pass !== NULL) {
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($ch, CURLOPT_USERPWD, "${auth_user}:${auth_pass}");
            }
            

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            if($timeout)
            {
                curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
                
                /// CURLOPT_CONNECTTIMEOUT 的默认值是 300 秒，我们希望将整个请求的时间控制在 timeout 以下，所以这里有必要重新设置 CONNECTTIMEOUT 值
                if ($timeout < 300) {
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                }
            }
            
            LOGD("请求链接：{$url}");
            if (!is_array($params)) {
                LOGD("请求链接时以 {$method} 方式发送数据：" . var_export($params, TRUE));
            }
            
            
            $t1 = microtime(TRUE);
            
            $result = curl_exec($ch);
            
            $t2 = microtime(TRUE) - $t1;
            

            if ($result === FALSE) {
                self::$curl_errno = curl_errno($ch);
                LOGW("curl 请求时发生错误（错误号“" . self::$curl_errno . "”）：" . curl_error($ch) . "。耗时 ${t2} 秒，请求链接：${url}");

                $not_sent_errnos = array(CURLE_COULDNT_RESOLVE_HOST, CURLE_COULDNT_CONNECT);
                if (in_array(self::$curl_errno, $not_sent_errnos)) {
                    LOGD("未向服务器发送数据，返回 FALSE");
                    $result = FALSE;
                }
                else {
                    LOGD("可能已经向服务器发送数据了，返回 NULL");
                    $result = NULL;
                }
            }
            else {
                LOGD("请求耗时 {$t2} 秒，原始返回结果：" . var_export($result, TRUE));
                
                $time_threshold = C('http_timeout_warning_threshold');
                if ($time_threshold && $t2 > $time_threshold) {
                    LOGW("花费了 {$t2} 秒才完成请求，URL： $url");
                }
            }
            
            
            curl_close ($ch);
            
            return $result;
        }
        else
        {
            $context = array(
                'http' => array(
                    'method' => $method,
                    'header' => 'Content-type: '.$contentType . "\r\n" .
                    'Content-length: ' . strlen($data_string),
                    'content' => $data_string
                    )
                );
            
            $contextid = stream_context_create($context);
            $sock = fopen($url, 'r', false, $contextid);
            if($sock)
            {
                $response = '';
                while(!feof($sock))
                    $response .= fgets($sock, 4096);
                fclose($sock);
                return $response;
            }
        }
    }
   

    public static function http_response($url, $status = null) 
    { 

            // we are the parent 
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, $url); 
            curl_setopt($ch, CURLOPT_HEADER, TRUE); 
            curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
            $head = curl_exec($ch); 
            
            
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
            curl_close($ch); 

            if(!$head) 
            { 
                return FALSE; 
            } 

            if($status === null) 
            { 
                if($httpCode < 400) 
                { 
                    return TRUE; 
                } 
                else 
                { 
                    return FALSE; 
                } 
            } 
            elseif($status == $httpCode) 
            { 
                return TRUE; 
            } 

            return FALSE; 
            
        } 
}
?>
