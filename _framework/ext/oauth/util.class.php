<?php
/**
 * OAuth 工具类
 **/

class Ext_OAuth_Util
{
    public static function urlencode($input)
    {
        if (is_array($input))
        {
            return array_map(array('Ext_OAuth_Util', 'urlencode'), $input);
        }
        else if (is_scalar($input))
        {
            return str_replace(array('+', '%7E'), array(' ', '~'), rawurlencode($input));
        }
        else
        {
            return '';
        }
    }

    /*public static function urlencode($input)
    {
        if (is_array($input))
        {
            return array_map(array('Ext_OAuth_Util', 'urlencode'), $input);
        }
        else if (is_scalar($input))
        {
            return str_replace('+',' ',str_replace('%7E', '~', rawurlencode($input)));
        }
        else
        {
            return '';
        }
    }*/

    public static function urldecode($string)
    {
        return urldecode($string);
    }

    public static function isUrl($url)
    {
        if(empty($url))
        {
            return false;
        }
        $urlPattern = '/^(http|https):\/\/[^\s&<>#;,"\'\?]*(|#[^\s<>;"\']*|\?[^\s<>;"\']*)$/i';
        return (bool)preg_match($urlPattern, $url);
    }
}
?>
