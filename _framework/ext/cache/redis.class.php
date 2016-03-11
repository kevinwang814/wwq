<?php
class Ext_Cache_Redis
{
    /**
     * @var object 对象单例
     */
    private static $_instance = NULL;

    /**
     * memcached连接句柄
     *
     * @var resource
     */
    protected $_conn;

    /**
     * 获取对象唯一实例
     *
     * @param void
     * @return Ext_Cache_Memcache 返回本对象实例
     */
    public static function getInstance($host = '', $port = '',$auth = '')
    {
        if (!(self::$_instance instanceof self))
        {
            self::$_instance = new self($host, $port,$auth);
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
     * @param array $config 配置数据数组
     */
    private function __construct($host = '', $port = '',$auth = '') {
        if($host && $port && $auth)
        {
            $this->redis = new Redis();
            $this->redis->connect($host, $port);
            $this->redis->auth($auth);
            //$this->redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);
        }else {
            return false;
        }
    }
    
    /**
     * 写入缓存
     *
     * @param string $key
     * @param mixed $data
     * @return boolean
     */
    function set($key, $data, $life_time = 86400)
    {
        if ($life_time === '')
        {
            $life_time = $this->_config['policy']['life_time'];
        }
        $this->redis->setex($key, $life_time, $data); 
    }

    /**
     * 读取缓存，失败或缓存撒失效时返回 false
     *
     * @param string $key
     * @return mixed
     */
    function get($key)
    {
        return $this->redis->get($key);
    }

    /**
     * 将 KEY 设为持久化的 
     * 
     * @param string  $key
     */
    function persist($key) {
        return $this->redis->persist($key);
    }

    /**
     * 批量获取多个缓存
     * 
     */
    function getMulti(array $keys)
    {
        $values = $this->redis->mGet($keys);
        return $values;
    }
    
    /**
     * 删除指定的缓存
     *
     * @param string $key
     * @return boolean
     */
    function delete($key)
    {
        return $this->redis->delete($key);
    }
    
    function incr($key) {
        return $this->redis->incr($key);
    }
    
    function decr($key) {
        return $this->redis->decr($key);
    }
    
    function hIncrBy($hash,$key,$incrBy){
        return $this->redis->hIncrBy($hash,$key,$incrBy);
    }
    
    public function rPush($key,$value){
        return $this->redis->rPush($key,$value);
    }
    //count=0: remove all  the elements  equal to  $value
    public function lREM($key,$value='',$count=0){
        return $this->redis->lRem($key,$value,$count);
    }
    
    public function hGet($key, $hashKey) {
        return $this->redis->hGet($key, $hashKey);
    }
    
    public function hSet($key, $hashKey, $value) {
        return $this->redis->hSet($key, $hashKey, $value);
    }
    
    public function hVals($key) {
        return $this->redis->hVals($key);
    }
    
    public function hDel($key, $hashKey) {
        return $this->redis->hDel($key, $hashKey);
    }
    
    public function hGetAll($key) {
        return $this->redis->hGetAll($key);
    }
    
    public function exists($key) {
        return $this->redis->exists($key);
    }
    
    public function expire($key, $ttl) {
        return $this->redis->expire($key, $ttl);
    }

    public function pexpire($key, $ttl) {
        return $this->redis->pexpire($key, $ttl);
    }
    public function setTimeout($key,$time){
        return $this->redis->setTimeout($key,$time);
    }
    
    public function incrBy($key,$step){
        return $this->redis->incrBy($key,$step);
    }

}
?>
