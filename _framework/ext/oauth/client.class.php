<?php
/**
 * OAuth 操作基础类
 *
 **/
class Ext_OAuth_Client
{
    /**
     * OAuth 版本
     */
    public static $oauth_version = '1.0';

    /**
     * Http 请求方法
     */
    public $http_method = 'GET';

    /**
     * 所要请求的URL
     */
    public $url = '';

    /**
     * 基础请求参数
     */
    public $base_params = array();

    /**
     * 用户请求参数
     */
    public $user_params = array();

    /**
     * 用于签名的basestring
     */
    public $base_string = '';

    /**
     * 请求类型，可以是 'request_token' , 'authorize' or 'access_token'
     */
    protected $request_type = 'request_token';

    
    public function  __construct()
    {
        //默认参数
        $this->base_params = array(
                'oauth_version' => self::$oauth_version,
                'oauth_nonce' => $this->getNonce(),
                'oauth_timestamp' => $this->getTimestamp(),
                'oauth_signature_method' => 'HMAC-SHA1',
        );
    }

    /**
     * 获取oauth_nonce
     */
    protected function getNonce()
    {
        return md5(uniqid(mt_rand(), true));
    }

    /**
     * 获取当前时间戳
     */
    protected function getTimestamp()
    {
        return time();
    }

    protected function getHttpMethod()
    {
        return strtoupper($this->http_method);
    }

    /**
     * 设置OAuth基础参数
     */
    public function setBaseParam($name, $value)
    {
        switch ($name)
        {
            case 'oauth_signature_method':
                if(in_array($value, array('HMAC-SHA1', 'MD5', 'PLAINTEXT')))
                {
                    $this->base_params['oauth_signature_method'] = $value;
                }
                break;
            case 'http_method':
                if(in_array($value, array('GET', 'POST')))
                {
                    $this->http_method = $value;
                }
                break;
            case 'oauth_version':
            //不能设置oauth版本
                break;
            case 'oauth_callback':
                if(Ext_OAuth_Util::isUrl($value))
                {
                    $this->base_params['oauth_callback'] = Ext_OAuth_Util::urlencode($value);
                }
                else
                {
                    throw new Exception("invalid oauth_callback url: $value");
                }
                break;
            default:
                $this->base_params[$name] = $value;
        }
    }

    public function setUserParam($user_params = array())
    {
        if(is_array($user_params))
        {
            $this->user_params = $user_params;
        }
    }

    public function resetUserParam()
    {
        $this->user_params = array();
    }

    /**
     * 设置请求Url
     */
    public function setUrl($url)
    {
        if(Ext_OAuth_Util::isUrl($url))
        {
            $this->url = $url;
        }
        else
        {
            throw new Exception("invalid $this->request_type url: $url");
        }
    }

    /**
     * 构造请求Url,$with_base_params是否合并系统参数，$check_type为参数检测类型
     */
    public function getRequestUrl($with_base_params = true,$check_type = '')
    {
        if($with_base_params)
        {
            $params = array_merge($this->user_params, $this->base_params);
        }
        else
        {
            $params = $this->user_params;
        }

        if($this->checkParams($params,$check_type))
        {
            $queryString = $this->buildQueryString($params);
            $url = $this->url;
            if (!empty($queryString))
            {
                $url .= '?'.$queryString;
            }
            return $url;
        }
    }

    protected function checkParams($params,$check_type)
    {
        $requires = array();
        
        if($check_type == 'request_token')
        {
            $requires = array(
                    'oauth_consumer_key',
                    'oauth_signature_method',
                    'oauth_timestamp',
                    'oauth_nonce',
                    'oauth_signature',
                    'oauth_version',
            );
        }
        else if($check_type == 'authorize')
        {
            $requires = array(
                    'oauth_token',
                    'oauth_callback',
            );
        }
        else if($check_type == 'access_token')
        {
            $requires = array(
                    'oauth_consumer_key',
                    'oauth_signature_method',
                    'oauth_timestamp',
                    'oauth_nonce',
                    'oauth_signature',
                    'oauth_token',
                    'oauth_version',
            );
        }

        if(count($requires))
        {
            foreach($requires as $value)
            {
                if(empty($params[$value]))
                {
                    throw new Exception('missing required parameter : ' . $value);
                }
            }
        }

        if(empty($this->url))
        {
            throw new Exception("missing {$check_type} url .");
        }

        return true;
    }

    public function signature($key_secret, $token_secret = null)
    {
        $signature_class = 'Ext_OAuth_SignatureMethod_' . str_ireplace('-', '', $this->base_params['oauth_signature_method']);
        $sc = new $signature_class();
        $signature = $sc->signature($this->getBaseString(), $key_secret, $token_secret);
        $this->base_params['oauth_signature'] = $signature;
    }

    /**
     * 获取签名所需要的basestring
     */
    protected function getBaseString()
    {
        //sort param
        $allParams = array_merge($this->base_params,$this->user_params);
        ksort($allParams);
        if (isset($allParams['oauth_signature']))
        {
            unset($allParams['oauth_signature']);
        }
        $tempParams = array(
                $this->getHttpMethod(),
                $this->url,
                $this->buildQueryString($allParams)
        );

        $tempParams = Ext_OAuth_Util::urlencode($tempParams);
        $this->base_string = implode('&', $tempParams);
        return $this->base_string;
    }
    
    /**
     * 构造请求数据
     */
    public function buildQueryString($params)
    {
        if(empty($params))
        {
            return '';
        }
        else
        {
            $queryArr = array();
            foreach($params as $key => $value)
            {
                $queryArr[] = Ext_OAuth_Util::urlencode($key) . '=' . Ext_OAuth_Util::urlencode($value);
            }
            return implode('&', $queryArr);
        }
    }
    
    /**
     * 构造OAuth 请求头
     */
    public function getOAuthHeaders($realm = null)
    {
        if($realm)
        {
            $out = 'Authorization: OAuth realm="' . Ext_OAuth_Util::urlencode($realm) . '",';
        }
        else
        {
            $out = 'Authorization: OAuth ';
        }

        $params = array();
        ksort($this->base_params);
        foreach ($this->base_params as $k => $v)
        {
            //we don't need other parameters
            if (substr($k, 0, 5) != "oauth") continue;

            $params[] = Ext_OAuth_Util::urlencode($k) . '="' .
                    Ext_OAuth_Util::urlencode($v) . '"';
        }
        
        return $out . implode(',', $params);
    }
}
?>