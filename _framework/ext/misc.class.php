<?php
class Ext_Misc
{
    
    static public function buildUrl($id, $type, $format, $img_hash,$bcs = 0)
    {
        ($bcs == 1) ? $host = C('bcs_img_host') : $host = C('img_host');
        $subDir = intval($id / 5000);
        return "http://{$host}/{$type}/{$format}/{$subDir}/{$img_hash}.jpg";
    }
    
    static public function buildPath($id,$type,$format,$img_hash) {
        $img_dir = C('img_dir');
        $subDir = intval($id / 5000);
        return "{$img_dir}/{$type}/{$format}/{$subDir}/{$img_hash}.jpg";
    }

    static public function delImage($img_hash, $type, $id)
    {
        $mapFormat = array(
            'user_icon' => array('180_180', '50_50'),
            'item' => array('original', 'width_650', 'width_192', '75_75')
        );

        if(isset($mapFormat[$type]))
        {
            $uploadDir = C('img_dir');
            $subDir = intval($id / 5000);
            $formatList = $mapFormat[$type];
            foreach($formatList as $format)
            {
                $path = "{$uploadDir}/{$type}/{$format}/{$subDir}/{$img_hash}.jpg";
                if(file_exists($path))
                {
                    unlink($path);
                }
            }
        }
    }
    
    static public function replaceImage($content, $type)
    {
        $mapType = array(
            'forum' => array(
                'pattern' => '/src="http:\/\/'.C('img_host').'\/tmp\/forum\/width_600\/(.*?)\/(.*?).jpg"/',
                'callback' => 'self::replaceForumImageCallBack'
            ),
            'message' => array(
                'pattern' => '/src="http:\/\/'.C('img_host').'\/tmp\/message\/width_600\/(.*?)\/(.*?).jpg"/',
                'callback' => 'self::replaceMessageImageCallBack'
            ),
            'diary' => array(
                'pattern' => '/src="http:\/\/'.C('img_host').'\/tmp\/diary\/width_600\/(.*?)\/(.*?).jpg"/',
                'callback' => 'self::replaceDiaryImageCallBack'
            )
        );
        return preg_replace_callback($mapType[$type]['pattern'], $mapType[$type]['callback'], $content);
    }
    
    static public function replaceForumImageCallBack($matches)
    {
        $subDir = isset($matches[1]) ? $matches[1] : '';
        $fileHash = isset($matches[2]) ? $matches[2] : '';
        if($subDir && $fileHash)
        {
            self::saveImage($subDir, $fileHash, 'forum');
            $imgHost = C('img_host');
            $url = "http://{$imgHost}/forum/width_600/{$subDir}/{$fileHash}.jpg";
            return 'src="' . $url . '"';
        }
        return '';
    }
    
    static public function replaceMessageImageCallBack($matches)
    {
        $subDir = isset($matches[1]) ? $matches[1] : '';
        $fileHash = isset($matches[2]) ? $matches[2] : '';
        if($subDir && $fileHash)
        {
            self::saveImage($subDir, $fileHash, 'message');
            $imgHost = C('img_host');
            $url = "http://{$imgHost}/message/width_600/{$subDir}/{$fileHash}.jpg";
            return 'src="' . $url . '"';
        }
        return '';
    }
    
    static public function replaceDiaryImageCallBack($matches)
    {
        $subDir = isset($matches[1]) ? $matches[1] : '';
        $fileHash = isset($matches[2]) ? $matches[2] : '';
        if($subDir && $fileHash)
        {
            self::saveImage($subDir, $fileHash, 'diary');
            $imgHost = C('img_host');
            $url = "http://{$imgHost}/diary/width_600/{$subDir}/{$fileHash}.jpg";
            return 'src="' . $url . '"';
        }
        return '';
    }
    
    static public function saveImage($subDir, $fileHash, $type, $tmpSubDir = true)
    {
        $uploadDir = C('img_dir');
        $mapType = array(
            'forum' => array('original','width_600'),
            'message' => array('original','width_600'),
            'diary' => array('original','150_150','width_600'),
            'item' => array('original','width_650','width_192','75_75')
        );
        
        if(isset($mapType[$type]))
        {
            foreach($mapType[$type] as $size)
            {
                $tmp_dir = $tmpSubDir ? "{$uploadDir}/tmp/{$type}/{$size}/{$subDir}" : "{$uploadDir}/tmp/{$type}/{$size}";
                $tmp_path = "{$tmp_dir}/{$fileHash}.jpg";

                $dest_dir = "{$uploadDir}/{$type}/{$size}/{$subDir}";
                Ext_Filesys::mkdirs($dest_dir);
                $dest_path = "{$dest_dir}/{$fileHash}.jpg";

                if(file_exists($tmp_path))
                {
                    rename($tmp_path, $dest_path);
                }
            }
        }
    }
    
    static public function api_output($data, $options = null)
    {
        if(is_array($data))
        {
            if(getv('debug') == '1')
            {
                if(!headers_sent())
                {
                    header('Content-Type:text/html; charset=utf8');
                }
                dump($data);
            }
            else
            {
                header('Content-Type:application/json;charset=utf8');
            }
            
            if (C('debug') === TRUE) {
                //$options |= JSON_UNESCAPED_UNICODE;
            }
            
            $options |= JSON_UNESCAPED_UNICODE;
            
            echo json_encode($data, $options);
            exit;
        }
    }
    
    static public function formatDeviceToken($device_token)
    {
        $device_token = str_replace("<", "", $device_token);
        $device_token = str_replace(">", "", $device_token);
        $device_token = str_replace(" ", "", $device_token);
        return $device_token;
    }
    
    static public function vali($val, $method='GET', $range = array()) {

        $apiData = array(
            'status' => 'failure',
        );
        
        $value = FALSE;
        
        if ($method == 'GET') {
            $value = getv($val, FALSE);
        }

        if($method == 'POST'){
            $value = postv($val, FALSE);
        }
        
        if($method == 'REQUEST'){
            $value = requestv($val, FALSE);
        }
        
        if ($value === FALSE) {
            $apiData['message'] = "缺少参数: {$val}";
            Ext_Misc::api_output($apiData);
        }            
        
        if (count($range) > 0) {
            if (!in_array($value, $range)) {
                $apiData['message'] = "参数不被支持: {$val}";
                Ext_Misc::api_output($apiData); 
            }
        } 
        
        return $value;
    }
    
    static public function max($val,$max) {
        if ($val < $max) {
            return $val;
        }
        return $max;
    }
    
    
    static function is_url($value)  {
        if (preg_match("/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"])*$/", $value)) {
            return true;
        }else{
            return false;
        }
    }
    
    
    static function genkey($keylen = 32, $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ12345678990') {
        $len = strlen($chars);
        
        $key = '';
        for ($i = 0; $i < $keylen; $i++) {
            $key .= $chars[rand(0, $len - 1) % $len];
        }
    
        return $key;
    }
    
    /**
     * array_column 函数在 PHP 5.5.0 开始才被支持，在此实现一个替代方法
     */
    static function array_column($input, $column_key, $index_key = null) {
        $ret = array();
        
        foreach ($input as $k => $v) {
            $value = null;
            
            if ($column_key === null) {
                $value = $v;
            }
            else {
                $value = $v[$column_key];
            }
            
            if ($index_key === null) {
                $ret[] = $value;
            }
            else {
                $ret[$v[$index_key]] = $value;
            }
        }
        
        return $ret;
    }
    static  function genSerialNo() {
        $s1 = base_convert(time(), 10, 36);
        while (strlen($s1) < 7) {
            $s1 = '0' . $s1;
        }

        $s2 = Ext_Misc::genkey(13);

        return strtoupper($s1 . $s2);
    }
    
    
    
    /**
     * 操作系统级的同步锁操作
     * 该函数未完成
     * 
     * @param string    锁名字
     * @param int       自定义的 sem 掩码，可以使用相同的锁名字配合不同的 key 来对不同的资源进行锁定
     */
    static function lock($name, $_key = NULL) {
        $path = "/tmp/huafeiduo_lock_{$name}_${_key}";
        
        $ret = touch($path);
        
        $key = ftok($path, 'h');    /// h is for Huafeiduo
        
        if ($key == -1) {
            LOGE("无法加锁，ftok 失败“{$path}”");
            throw new Exception("无法加锁，ftok 失败：${path}");
            return FALSE;
        }
        
        if ($_key !== NULL) {
            $key |= $_key;
        }


        /**
         * 由于不能重置 sem_get() 返回的变量，而且这个变量也不能是局部变量（因为会被重置），所以每次调用必须将 sem 保存在一个唯一的全局变量中
         */
        static $r = NULL;
        if ($r === NULL) {
            $r = 1;
        }
        else {
            $r++;
        }
        $r = "Ext_Misc_lock_{$path}_{$r}";


        
        $GLOBALS[$r] = sem_get($key);
        
        if ($GLOBALS[$r] == FALSE) {
            LOGE("无法获取 sem，相关文件是“{$path}");
            throw new Exception("无法获取 sem，相关文件是“{$path}");
            return FALSE;
        }
        
        LOGD("锁定资源“{$name}”，_key=" . var_export($_key, TRUE) . "，sem key={$key}");
        
        $ret = sem_acquire($GLOBALS[$r]);
        
        return $ret;
    }
    
    static function unlock($name, $_key = NULL) {
        $path = "/tmp/huafeiduo_lock_${name}_${_key}";
        
        $fp = fopen($path, 'w');
        
        $key = ftok($path, 'h');    /// h is for Huafeiduo
        
        if ($key == -1) {
            LOGE("无法解锁，ftok 失败“{$path}”");
            throw new Exception("无法解锁，ftok 失败：${path}");
            return FALSE;
        }
        
        if ($_key !== NULL) {
            $key |= $_key;
        }


        static $r = NULL;
        if ($r === NULL) {
            $r = 1;
        }
        else {
            $r++;
        }
        $r = "Ext_Misc_lock_{$path}_{$r}";


        $GLOBALS[$r] = sem_get($key);
        
        if ($GLOBALS[$r] == FALSE) {
            LOGE("无法获取 sem，相关文件是“{$path}");
            throw new Exception("无法获取 sem，相关文件是“{$path}");
            return FALSE;
        }
        
        LOGD("解锁资源“{$name}”，_key=" . var_export($_key, TRUE) . "，sem key={$key}");
        
        $ret = sem_release($GLOBALS[$r]);
        
        return $ret;
    }
    
    
    /**
     * 使用 flock 实现的系统级锁
     */
    static function flock($name) {
        $path = "/tmp/huafeiduo_flock_{$name}";
        
        $fp = fopen($path, 'w');
        
        
        if (!$fp) {
            LOGE("无法加锁，无法打开文件“{$path}”");
            throw new Exception("无法加锁，无法打开文件：${path}");
            return FALSE;
        }
        
        LOGD("对“{$path}”进行加锁");
        
        return flock($fp, LOCK_EX);
    }
    
    static function funlock($name) {
        $path = "/tmp/huafeiduo_flock_{$name}";
        
        $fp = fopen($path, 'w');
        
        
        if (!$fp) {
            LOGE("无法加锁，无法打开文件“{$path}”");
            throw new Exception("无法加锁，无法打开文件：${path}");
            return FALSE;
        }
        
        
        LOGD("对“{$path}”进行解锁");
        
        return flock($fp, LOCK_UN);

    }
}
?>
