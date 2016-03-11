<?php
class Ext_Phone
{
    public static $MOBILE = '移动';
    public static $UNICOM = '联通';
    public static $TELECOM = '电信';
    
    const MOBILE = '移动';
    const UNICOM = '联通';
    const TELECOM = '电信';
    
    /**
     * 大陆地区省份列表
     */
    public static $provinces = array('安徽', '北京', '重庆', '福建', '甘肃', '广东', '广西', '贵州', '海南', '河北', '河南', '黑龙江', '湖北', '湖南', '吉林', '江苏', '江西', '辽宁', '内蒙古', '宁夏', '青海', '山东', '山西', '陕西', '上海', '四川', '天津', '西藏', '新疆', '云南', '浙江');

    
    /**
     * 获取手机号码归属地信息
     * 
     * @param string     手机号码
     * @param boolean   是否进行网络查询。如果设为 true，在本地数据库中没有查询到归属地信息时，会通过网络去查询归属地信息
     * @return string   号码归属地，精确到市。如果没有查询到则返回 null
     */
    public static function getArea($mobile_num, $sync = false) {
        $province = '';
        $city = '';
        
        /// 从本地数据库查询
        $ret = self::getAreaFromCache($mobile_num);
        if ($ret) {
            return $ret;
        }
        
        
        /// 从网络查询
        if ($sync == true) {
            $ret = self::getAreaFromNetwork($mobile_num);
            
            if ($ret) {
                self::setAreaToCache($mobile_num, $ret);
            }
            
            return $ret;
        }
     
        return null;
    }
    
    /**
     * 获取手机号码的归属地（精确到市）的字符串，如“广西南宁”，“上海上海”等。
     * 其他参数及行为和 getArea 方法一致。
     * 
     * @param string    手机号码
     * @param boolean   是否通过网络查询
     * @return string   归属地信息
     */
    public static function getAreaString($mobile_num, $sync = false) {
        $area = self::getArea($mobile_num, $sync);
        if (!empty($area)) {
            $area = str_replace(' ', '', $area);
            $area = str_replace('　', '', $area);
        }
        
        return $area;
    }
    
    /**
     * 调用 getArea* 函数族，通过网络获取手机号码信息
     * 
     * @param string    手机号码
     * @return mixed   号码归属地，精确到市。如果没有查询到则返回 null
     */
    public static function getAreaFromNetwork($mobile_num) {
        LOGD("准备通过网络查询“{$mobile_num}”的归属地");
        
        $province = '';
        $city = '';
        
        $funcs = array(
            'Tenpay',
            '115'
            //'096'   /// 096 的数据格式不规范，没法用
        );
     
       foreach ($funcs as $func) {
            $funcname = "getArea${func}";
            
            $ret = self::$funcname($mobile_num);

            if (!$ret) {
                continue;
            }
            
            if (array_key_exists('province', $ret)) {
                $province = $ret['province'];
            }
            if (array_key_exists('city', $ret)) {
                $city = $ret['city'];
            }
            
            if ($province != '' && $city != '') {
                break;
            }
            else {
                $province = $city = '';
            }
        }
        
        
        if ($province == '' || $city == '') {
            return null;
        }
        else {
            return "$province $city";
        }
    }
    
    
    /**
     * getArea* 函数族。从特定的平台获取手机号码信息
     * 
     * @param string    手机号码
     * @param mixed     该号码的信息，可能包含一项或多项信息，如果获取失败返回 null。成功时返回格式类似：array('province' => '北京', city='海淀')。可能的键值有：province, city, isp
     */
    public static function getAreaTenpay($mobile_num) {
        /// 财付通接口
        $url = "http://life.tenpay.com/cgi-bin/mobile/MobileQueryAttribution.cgi";
        
        $ret = Ext_Http::sendRequest($url, array('chgmobile' => $mobile_num), 'GET');
        
        if (!$ret) {
            return null;
        }
        
        
        /// 财付通还在使用老掉牙的 GB2312 编码
        //$response = iconv('gb2312', 'utf-8', $ret);
        $response = mb_convert_encoding($ret, 'UTF-8', 'GB2312');
        
        $matches = array();
        $ret = array();
        
        if (preg_match('/<province>(.+)<\/province>/', $response, $matches)) {
            $ret['province'] = trim($matches[1]);
        }
        if (preg_match('/<city>(.+)<\/city>/', $response, $matches)) {
            $ret['city'] = trim($matches[1]);
        }
        if (preg_match('/<supplier>(.+)<\/supplier>/', $response, $matches)) {
            $ret['isp'] = trim($matches[1]);
        }
        
        if (!array_key_exists('province', $ret)) {
            return false;
        }
        if (!array_key_exists('city', $ret)) {
            return false;
        }
        
                
        /// 部分情况下财付通会返回奇怪的结果（一个半角横杠“-”），过滤之
        if (strlen($ret['province']) <= 1) {
            unset($ret['province']);
        }
        if (strlen($ret['city']) <= 1) {
            unset($ret['city']);
        }
        
        
        return $ret;
    }
    
    public static function getArea115($mobile_num) {
        /// 115 接口
        $url = 'http://cz.115.com/';
        
        $params = array(
            'ct' => 'index',
            'ac' => 'get_mobile_local',
            'mobile' => $mobile_num
        );
        
        $ret = Ext_Http::sendRequest($url, $params, 'GET');
        
        if (!$ret) {
            return null;
        }
        
        /// 115 返回的是 jsonp 类型的数据，需要删掉两头的括号
        $ret = preg_replace('/^\((.+)\)$/', '$1', $ret);
        
        
        $ret = json_decode($ret);
        
        if (!$ret) {
            return null;
        }

        $province = $ret->province;
        $city = $ret->city;
        $isp = $ret->corp;
        
        $ret = self::splitArea($province);
        $ret['isp'] = $isp;

        return $ret;
    }
    
    public static function getArea096($mobile_num) {
        $url = 'http://www.096.me/api.php?phone=18658829750&mode={txt}';
        
        $params = array(
            'mode' => '{txt}',
            'phone' => $mobile_num
        );
        
        $response = Ext_Http::sendRequest($url, $params, 'GET');
        
        if (!$response) {
            return null;
        }
        
        //$response = iconv('gb2312', 'utf-8', $response);
        $response = mb_convert_encoding($response, 'UTF-8', 'GB2312');

        
        /// 范例结果：
        /// 18658829750||浙江杭州,联通3G,0571,邮编：310000||则此人拥有非常人的能力，能够跳出三界外，不在五行中，这样散仙级的人物，自然是：经常处于戒备状态，对任何事都没法放松处理，孤僻性情难以交朋结友。对于爱情，就更加会慎重处理。任何人必须经过你长期观察及通过连番考验，方会减除戒备与你交往。
        
        $response = explode('||', $response);
        if (count($response) < 2) {
            return null;
        }
        
        $response = explode(',', $response[1]);
        if (count($response) < 2) {
            return null;
        }
        
        
        
        $ret = self::splitArea($response[0]);
        $ret['isp'] = preg_replace('/[0-9A-Z]+/', $response[1]);
        
        return $ret;
    }
    
    /**
     * 将一个包含省份和城市的地址切分成省份和地址分开的结果
     * 
     * @param string    包含省份和城市的地址，如“广西壮族自治区南宁市”或“广西省南宁市”
     * @param array     拆分结果，如 array('province' => '广西', 'city' => '南宁')
     */
    public static function splitArea($area) {
        $city = '';
        $province = '';
        
        foreach (self::$provinces as $v) {
            if (strpos($area, $v) !== false) {
                $province = $v;

                $city = str_replace($province, '', $area);
                $city = str_replace('省', '', $city);
                $city = str_replace('自治区', '', $city);
                $city = str_replace('壮族', '', $city);   /// 替换“广西壮族自治区”
                $city = str_replace('维吾尔族', '', $city); /// 替换“新疆维吾尔族自治区”
                $city = str_replace('回族', '', $city);   /// 替换“宁夏回族自治区”
                $city = str_replace('市', '', $city);   /// “替换某某市，如“南宁市”
                $city = str_replace('区', '', $city);   /// 替换某某区，如“海淀区”
                
                break;
            }
        }
        
        $ret = array();
        $ret['city'] = $city;
        $ret['province'] = $province;
        
        return $ret;
    }
    
    
    /**
     * 从本地缓存（数据库）获取号码归属地信息
     * 
     * @param string    手机号码
     * @return string   号码归属地信息，如果查询不到则返回 null
     */
    public static function getAreaFromCache($mobile_num) {
        $redis = Ext_Cache_Redis::getInstance(C('redis.redis_host'), C('redis.redis_port'), C('redis.redis_auth'));
        
        $key = 'mobile:area:' . substr($mobile_num, 0, 7);
        $ret = $redis->get($key);
        
        if ($ret) {
            return $ret;
        }
        else {
            return null;
        }
    }
    
    /**
     * 将号码归属地信息保存到本地数据库（缓存）
     *
     * @param string    手机号码 
     * @param string    归属地信息
     */
    public static function setAreaToCache($mobile_num, $area) {
        $redis = Ext_Cache_Redis::getInstance(C('redis.redis_host'), C('redis.redis_port'), C('redis.redis_auth'));
        
        $key = 'mobile:area:' . substr($mobile_num, 0, 7);
        $ret = $redis->set($key, $area, 86400);
        $redis->persist($key);

        if ($ret) {
            return $ret;
        }
        else {
            return null;
        }
    } 
    
    
    /**
     * 获取手机号码所属的运营商名字
     * 
     * @param string    手机号码
     * @return string   运营商名字。可以使用本类内的常量：MOBILE, UNICOM, TELECOM
     */
    public static function getISP($mobile_num) {
        switch (substr($mobile_num, 0, 3)) {
            case "134":
            case "135":
            case "136":
            case "137":
            case "138":
            case "139":
            case "147":
            case "150":
            case "151":
            case "152":
            case "157":
            case "158":
            case "159":
            case "182":
            case "183":
            case "184":
            case "187":
            case "188":
            case "178":
                return self::$MOBILE;
            
            case "130":
            case "131":
            case "132":
            case "145":
            case "155":
            case "156":
            case "185":
            case "186":
            case "176":
                return self::$UNICOM;
                
            case "133":
            case "153":
            case "180":
            case "189":
            case "181":
            case "177":
                return self::$TELECOM;
        }
        
        return 'UNKNOWN';
    }
    
    
    /**
     * 获取手机号码归属地的运营商信息（小写英文），如 mobile, unicom, telecom 等
     * 
     * @param string    手机号码
     * @return string   小写的运营商英文名字，如果无法获取运营商信息则返回 NULL
     */
    public static function getISPEn($mobile_num) {
        switch (self::getISP($mobile_num)) {
            case self::MOBILE:
                return 'mobile';
                
            case self::UNICOM:
                return 'unicom';
                
            case self::TELECOM:
                return 'telecom';
                
            default:
                return NULL;
        }
        
        return NULL;
    }
    
    /*
     * 将运营商由中文转换为英文
     * #param string $ISPChinese ISP中文形式 如:移动,联通,电信
     */
    public static function ISPChinese2En($ISPChinese){
        switch ($ISPChinese) {
            case self::MOBILE:
                return 'mobile';
                
            case self::UNICOM:
                return 'unicom';
                
            case self::TELECOM:
                return 'telecom';
                
            default:
                return NULL;
        }
        
        return NULL;
    }

    /**
     * 获取所有手机号码前缀
     */
    public static function getAllISPPrefix() {
        return array(
            "134", "135", "136", "137", "138", "139", "147", "150", "151", "152", "157", "158", "159", "182", "183", "184", "187", "188",
            "130", "131", "132", "145", "155", "156", "185", "186",
            "133", "153", "180", "189", "181"
        );
    }
    
    /**
     * 根据运营商返回运营商的前缀
     * 
     * @param string    运营商名字
     */
    public static function getISPPrefix($isp) {
        switch ($isp) {
            case self::$MOBILE:
                return array("134", "135", "136", "137", "138", "139", "147", "150", "151", "152", "157", "158", "159", "182", "183", "184", "187", "188");
            case self::$UNICOM:
                return array("130", "131", "132", "145", "155", "156", "185", "186");
            case self::$TELECOM:
                return array("133", "153", "180", "189", "181");
            default:
                throw new Exception("运营商名字“{$isp}”未知");
        }
        
        return NULL;
    }
}
?>
