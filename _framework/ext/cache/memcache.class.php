<?php
class Ext_Cache_Memcache
{
    /**
     * @var object 对象单例
     */
    private static $_instance = NULL;

    /**
     * @var 配置文件数组
     */
    protected $_config = array(
        /*'servers' => array(
            array(
                'host' => '127.0.0.1',
                'port' => '11211'
            )
        ),*/

        'policy'  => array(
            'compressed' => true,
            'life_time' => 86400,
        )
    );


    /**
     * memcached连接句柄
     *
     * @var resource
     */
    protected $_conn;

    
    /**
     * @param array $config 配置数据数组
     */
    private function __construct($host = '', $port = '') {
        if($host && $port)
        {
            $this->_config['servers'][] = array(
                'host' => $host,
                'port' => $port,
            );
        }
        else
        {
            $this->_config['servers'][] = array(
                'host' => C('memcached_host'),
                'port' => '11211',
            );
        }
        $this->_conn = new Memcached('mc');
        $this->_conn->setOption(Memcached::OPT_COMPRESSION,$this->_config['policy']['compressed']);
        if (!count($this->_conn->getServerList()))
        {
            foreach ($this->_config['servers'] as $server)
            {
                $result = $this->_conn->addServer($server['host'], $server['port']);
                if (!$result)
                {
                    throw new ephpException(sprintf('connect memcached server [%s:%s] failed!', $server['host'], $server['port']));
                }
            }
        }
    }
    
    /**
     * 获取对象唯一实例
     *
     * @param void
     * @return Ext_Cache_Memcache 返回本对象实例
     */
    public static function getInstance($host = '', $port = '')
    {
        if (!(self::$_instance instanceof self))
        {
            self::$_instance = new self($host, $port);
        }
        return self::$_instance;
    }

    /**
     * 保证对象不被clone
     */
    private function __clone()
    {
        
    }

    /**
     * 写入缓存
     *
     * @param string $key
     * @param mixed $data
     * @return boolean
     */
    function set($key, $data, $life_time = '')
    {
        if ($life_time === '')
        {
            $life_time = $this->_config['policy']['life_time'];
        }
        
        $this->_conn->set($key, $data, $life_time);
    }

    /**
     * 读取缓存，失败或缓存撒失效时返回 false
     *
     * @param string $key
     * @return mixed
     */
    function get($key)
    {
        return $this->_conn->get($key);
    }

    /**
     * 批量获取多个缓存
     * 
     */
    function getMulti(array $keys)
    {
        return $this->_conn->getMulti($keys);
    }
    
    /**
     * 删除指定的缓存
     *
     * @param string $key
     * @return boolean
     */
    function delete($key)
    {
        return $this->_conn->delete($key);
    }

    /**
     * 清除所有的缓存数据
     *
     * @return boolean
     */
    function flush()
    {
        return $this->_conn->flush();
    }
}
?>