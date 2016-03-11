<?php
class Ext_PinYin
{
    // 码表
    private $fp = null;
    private $dat = 'pinyin.dat';

    /**
     * @var object 对象单例
     */
    private static $_instance = NULL;
    
    /**
     * 保证对象不被clone
     */
    private function __clone()
    {
        
    }
    
    /**
     * 获取对象唯一实例
     *
     * @param void
     * @return FDX_View 返回本对象实例
     */
    public static function getInstance()
    {
        if(!(self::$_instance instanceof self))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function __construct()
    {
        $this->dat = FW_PATH . '/misc/pinyin/' . $this->dat;
        if(is_file($this->dat))
        {
            $this->fp = fopen($this->dat, 'rb');
        }
    }

    /**
     * 转拼音
     *
     * @param string $str   汉字
     * @param bool $ucfirst 首字母大写
     * @param bool $polyphony 忽略多读音
     * @return string
     */
    public function encode($str, $ucfirst=true, $polyphony=true)
    {
        $ret = '';
        $len = mb_strlen($str, 'UTF-8');
        for($i = 0; $i < $len; $i++)
        {
            $py = $this->pinyin(mb_substr($str, $i, 1, 'UTF-8'));
            if(strpos($py, ',') !== false)
            {
                $pys = explode(',', $py);
                if($ucfirst)
                {
                    $ret.= implode(',', array_map('ucfirst', ($polyphony ? array_slice($pys, 0, 1) : $pys)));
                }
                else
                {
                    $ret.= implode(',', $polyphony ? array_slice($pys, 0, 1) : $pys);
                }
            }
            else
            {
                $ret.= $ucfirst ? ucfirst($py) : $py;
            }
        }
        return $ret;
    }

    /**
     * 汉字转十进制
     *
     * @param string $word
     * @return number
     */
    private function char2dec($word)
    {
        $bins = '';
        $chars = str_split($word);
        foreach($chars as $char)
            $bins.= decbin(ord($char));
        $bins = preg_replace('/^.{4}(.{4}).{2}(.{6}).{2}(.{6})$/', '$1$2$3', $bins);
        return bindec($bins);
    }

    /**
     * 单个字转拼音
     *
     * @param string $char  汉字
     * @return string
     */
    public function pinyin($char)
    {
        if(strlen($char) == 3 && $this->fp)
        {
            $offset = $this->char2dec($char);
            // 判断 off 值
            if($offset >= 0)
            {
                fseek($this->fp, ($offset - 19968) << 4, SEEK_SET);
                return trim(fread($this->fp, 16));
            }
        }
        return $char;
    }

    public function __destruct()
    {
        if($this->fp)
        {
            fclose($this->fp);
        }
    }
}
