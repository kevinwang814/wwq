<?php
class Ext_String
{
    public static function addlink($str) {
        //$str = preg_replace("/(^|[\s ])([\w]*?)((ht|f)tp(s)?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a href=\"$3\" target=\"_blank\">$3</a>", $str);
        $str = str_replace("<br>"," <br> ",$str);
	preg_match_all("/(^|[\s ])([\w]*?)((ht|f)tp(s)?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", $str, $matchesarray);
	if (is_array($matchesarray['3'])) {
	    foreach($matchesarray['3'] as $link) {
		$smalllink = Ext_String::makeLinkShort($link);
		$str = str_replace($link, '<a class="external" href="'.$link.'" target="_blank">'.$smalllink.'</a>', $str);
	    }
	}
	return $str;
    }
    
    public static function makeLinkShort($link) {
        if (strlen($link) > 30) {
		    $smalllink = substr($link,0,30).'...';
        }else {
            $smalllink = $link;
        }
        $smalllink = str_replace('http://', '', $smalllink);
        $smalllink = str_replace('www.', '', $smalllink);
        return $smalllink;
    }
    
    public static function trim($array) {
    	foreach($array as $key => $value) {
    		$array[$key] = trim($value);
    	}
    	return $array;
    }
    
    public static function filterlink($str)
    {
        $str = preg_replace("/<a[^>]*href=[^>]*>|<\/[^a]*a[^>]*>/i","",$str);
        return $str;
    }
    
    public static function br2nl($str)
    {
        return preg_replace('/<br\\s*?\/??>/i', '', $str);
    }
    
    public static function br2p($str) {
	$str = '<p>' . $str . '</p>';
        $str = preg_replace("/[\r\n]{2,}/", "</p><p class='blank'></p><p>", $str);
        $str = str_replace("\n", "</p><p>", $str);
	return $str;
    }

    public static function n2br($str) {
	$str = '<p>' . $str . '</p>';
        $str = preg_replace("/[\r]{2,}/", "<br>", $str);
        $str = str_replace("\n", "<br>", $str);
	return $str;
    }
    
    public static function q2b($str, $coding='UTF-8')
    {
        if($coding != 'UTF-8')
        {
            $str = mb_convert_encoding($str, 'UTF-8', $coding);
        }
        
        $ret = '';
        for($i = 0; $i < strlen($str); $i++)
        {
            $s1 = $str[$i];
            if(($c = ord($s1)) & 0x80)
            {
                $s2 = $str[++$i];
                $s3 = $str[++$i];
                $c = (($c & 0xF) << 12) | ((ord($s2) & 0x3F) << 6) | (ord($s3) & 0x3F);
                if($c == 12288)
                {
                    $ret.=' ';
                }
                elseif($c > 65280 && $c < 65375 && $c != 65374)
                {
                    $c-=65248;
                    $ret.=chr($c);
                }
                else
                {
                    $ret.=$s1 . $s2 . $s3;
                }
            }
            else
            {
                $ret.=$str[$i];
            }
        }
        if($coding != 'UTF-8')
        {
            return mb_convert_encoding($ret, $coding, 'UTF-8');
        }
        else
        {
            return $ret;
        }
    }  
    
    public static function cleanHtml($content) {
        $content = strip_tags($content, '<ul><div><ol><li><br><p><b><u><blockquote><img>');
        $content = preg_replace('%style="[^"]+"%i', '', $content);

        return $content;
    }
    
    public static function cleanAllHtml($content) {
        $content = strip_tags($content, '');
        $content = preg_replace('%style="[^"]+"%i', '', $content);

        return $content;
        
    }
    
    	
    /**
     * 截字符
     *
     * @return string
     */
    public static function cut($str,$len,$more=true){
        $str= preg_replace("/<(.*?)>/","",$str);
        if (strlen($str) <= $len) return $str;
         $n = 0;
         $tempstr = '';
         for ($i=0; $i<$len; $i++) {
             if (ord(substr($str,$n,1)) > 224) {
                 $tempstr .= substr($str,$n,3);
                 $n += 3;
                 $i++; //把一个中文按两个英文的长度计算
             } elseif (ord(substr($str,$n,1)) > 192) {
                 $tempstr .= substr($str,$n,2);
                 $n += 2;
                 $i++; //把一个中文按两个英文的长度计算
             } else {
                 $tempstr .= substr($str,$n,1);
                 $n ++;
             }
         }
         if ($more) {
            return $tempstr.'...';
         }else {
             return $tempstr;
         }

    }
    
    /*转换相对路径和绝对路径*/
    public static function absolute_to_relative($page_url,$img_url) {
        
        if (strstr($img_url, 'http') == $img_url) {
            return $img_url;
        }
        
        if (strpos($img_url, '/') !== 0) {
            $img_url = '/'.$img_url;
        }
        
        $urlarr = explode('/',$page_url);
        $urlarr = array_slice($urlarr,0,3);
        $weburl = implode('/', $urlarr);
        
        return $weburl.$img_url;
    }
    
    public static function is_url($url) {
        return preg_match('/http(s)?:\/\/.+/', $url);   
    }
    
    public static function in_url($url) {
        $urllist = array(
            'http://www.jimuu.com',
            'http://jimuu.com',
            'http://xjz.6600.org',
        );
        $find = 0;
        foreach($urllist as $urlone) {
            if (strstr($url, $urlone)) {
                $find = 1;
            }
        }
        
        if ($find) {
            return true;
        }
        return false;
    }
    
    public static function get_by_keyword($string,$before,$end,$recurrence = false) {
        
        if (!$before || !$end || !$string) {
            return false;
        }
        
        
            
        $str1 = strstr($string,$before);    //得到从$before开始的余下字符串
        
        if (!$str1) 
            return false;
        
        $str2 = substr($str1,strlen($before));  //得到去掉$before部分的字符串

        $str_station = strpos($str2,$end);  //在字符串$str2中找到end第一次出现的位置
        //$str_test = Ext_String::cut($str2,$str_station,false);


        //$str3 = substr($str1,strlen($before),$str_station); //截取出来
        $str3 = substr($str2,0,$str_station); 

        //$strunfind = substr($str2,$str_station,strlen($str2)); //余下还没有搜索的部分

        return $str3;
    }
    
    
    public static function replace_keywords($string,$keywords) {
        if (is_array($keywords)) {
            foreach($keywords as $keyword => $replaceword) {
                $string = str_replace($keyword,$replaceword,$string);
            }
            return $string;
        }
    }


    public static function remove_keywords($string,$keywords) {
        if (is_array($keywords)) {
            foreach($keywords as $keyword) {
                $string = str_replace($keyword,'',$string);
            }
            return $string;
        }else {
            $string = str_replace($keywords,'',$string);
            return $string;
        }
    }
    
    
    public static function unicode_encode($name)
    {
        $name = iconv('UTF-8', 'UCS-2', $name);
        $len = strlen($name);
        $str = '';
        for ($i = 0; $i < $len - 1; $i = $i + 2)
        {
            $c = $name[$i];
            $c2 = $name[$i + 1];
            if (ord($c) > 0)
            {    // 两个字节的文字
                $str .= '\u'.base_convert(ord($c), 10, 16).base_convert(ord($c2), 10, 16);
            }
            else
            {
                $str .= $c2;
            }
        }
        return $str;
    }

    public static function unicode_decode($name)
    {
        // 转换编码，将Unicode编码转换成可以浏览的utf-8编码
        $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
        preg_match_all($pattern, $name, $matches);
        if (!empty($matches))
        {
            $name = '';
            for ($j = 0; $j < count($matches[0]); $j++)
            {
                $str = $matches[0][$j];
                if (strpos($str, '\\u') === 0)
                {
                    $code = base_convert(substr($str, 2, 2), 16, 10);
                    $code2 = base_convert(substr($str, 4), 16, 10);
                    $c = chr($code).chr($code2);
                    $c = iconv('UCS-2', 'UTF-8', $c);
                    $name .= $c;
                }
                else
                {
                    $name .= $str;
                }
            }
        }
        return $name;
    }
    
    
    
    /**
        根据给的前缀和后缀字符串截取中间的字符串
        @param str 被截取字符串
        @param start 给定前缀字符串
        @param end 给定后缀字符串
        @return 返回截取后的字符串
    */
    static function mysub($str, $startstr, $endstr){
        $startindex = stripos($str, $startstr);
        $endindex = stripos($str, $endstr);
        //startstr,endstr有一个不被包含或startindex>endindex则返回空串
        if ($startindex === FALSE || $endindex === FALSE){
            return "";
        }
        $start = $startindex + strlen($startstr);
        $end = stripos($str, $endstr, $start);
        //如果在startstr后面未找到endstr，则返回空串
        if ($end === FALSE){
            return "";
        }
        $str2 = substr($str, $start, $end - $start);
        return $str2;
    }    

    /**
     * mysub加强版，循环截取两个字符串中间的内容，返回一个字符串数组
     * exclude:排除在外的字符串，如果截取时匹配到exclude则忽略
     */
    static function mysubMore($str, $startstr, $endstr, $exclude=''){
        $ret = array();
        $startindex = stripos($str, $startstr);
        $endindex = stripos($str, $endstr);
        if ($startindex === FALSE || $endindex === FALSE){
            return $ret;
        }
        $i = 0;
        while ($startindex > -1){
            $start = $startindex + strlen($startstr);
            $end = stripos($str, $endstr, $start);
            if ($end === FALSE){
                break;
            }
            else{
                $cutStr = substr($str, $start, $end - $start);
                if ($cutStr != $exclude){
                    $ret[$i] = $cutStr;
                    $i = $i + 1;
                }
            }
            $startindex = stripos($str, $startstr, $end);
        }
        return $ret;
    }
    
    
}

?>
