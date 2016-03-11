<?php

/**
 * 数据库driver
 */
class Core_Driver_Mysqli
{
    public $sql = '';
    private $_conn = false;
    static private $_db_handle;
    static public $statistics ;
    static private $trans_nested_count = 0;

    function __construct($db_config='default')
    {
        if(!isset(self::$_db_handle[$db_config]))
        {
            $iconfig = C("db.{$db_config}");
            
            $this->_conn = new mysqli($iconfig['host'], $iconfig['user'], $iconfig['password'], $iconfig['dbname']);
            
            if(mysqli_connect_errno())
            {
                show_error('无法连接到数据库，错误信息: ' . mysqli_connect_error());
            }

            $this->_conn->set_charset("utf8");
            self::$_db_handle[$db_config] = $this->_conn;
        }
        else
        {
            $this->_conn = self::$_db_handle[$db_config];
        }
    }

    /**
     * MYSQL query
     * @param  String $sql
     * @return mixed
     */
    function query($sql)
    {
        $this->sql = $sql;
        
        /// 记录 SQL 执行时间
        $t1 = microtime(true);

        if(true == ( $rs = $this->_conn->query($sql) ))
        {
            self::$statistics[] = array(
                'sql' => $sql,
                'time' => microtime(true) - $t1
            );
            
            return $rs;
        }
        else if(C('show_errors'))
        {
            throw new Core_Exception('执行mysqli::query()出现错误: ' . $this->_conn->error . '<br />原SQL: ' . $sql, 2045);
        }
        else
        {
            LOGE("执行mysqli::query()出现错误: " . $this->_conn->error . ". SQL: $sql", 'db');
            exit('db driver query() error.');
        }
    }
    
    /**
     * 获取单条记录,返回数据格式array
     * @param string $sql
     * @return mixed
     */
    function fetch_array($sql)
    {
        $this->sql = $sql;
        return $this->query($sql)->fetch_assoc();
    }

    /**
     * 获取多条记录，返回数据格式array
     * @param string $sql
     * @return mixed
     */
    function fetch_arrays($sql)
    {
        $this->sql = $sql;
        $rs = $this->query($sql);
        $data = null;
        while(true == ($row = $rs->fetch_assoc()))
        {
            $data[] = $row;
        }
        $rs->free();
        return $data;
    }

    /**
     * 获取一条记录,以object的方式返回数据
     * @param string $sql
     */
    function fetch_object($sql)
    {
        $this->sql = $sql;
        return $this->query($sql)->fetch_object();
    }

    /**
     * 查询多条记录，以objects的方式返回数据
     * @param string $sql
     */
    function fetch_objects($sql)
    {
        $this->sql = $sql;
        $rs = $this->query($sql);
        $data = null;
        while(true == ($row = $rs->fetch_object()))
        {
            $data[] = $row;
        }
        $rs->free();
        return $data;
    }

    /** return last insert id。 * */
    public function insert_id()
    {
        return $this->_conn->insert_id;
    }

    /** 影响的行数。 * */
    public function affected_rows()
    {
        return $this->_conn->affected_rows;
    }

    /** 最后执行的sql语句。 * */
    public function getLastSql()
    {
        return $this->sql;
    }

    /**
     * 转义SQL查询字符
     */
    public function escapeString($str)
    {
        if(get_magic_quotes_gpc())
        {
            $str = stripslashes($str);
        }
        return mysqli_real_escape_string($this->_conn, $str);
    }
    
    /**
     * 开始一个事务
     */
    public function beginTransaction()
    {
        $ret = TRUE;
        
        /// FIXME: 针对不同的数据库配置文件，应该保存独立的 trans_nested_count 变量，commit 和 rollback 方法中亦应如此
        self::$trans_nested_count++;
        
        /// 事务嵌套处理
        if (self::$trans_nested_count == 1) {
            /// 第一层事务，直接开始运行
            LOGD("开始执行事务，这是第 " . self::$trans_nested_count . " 层事务，执行 START TRANSACTION");
            
            /// PHP 版本小于 5.5，没有 begin_transaction 方法，只能手动执行 SQL
            $ret = $this->_conn->real_query('START TRANSACTION');
        }
        else if (self::$trans_nested_count > 1) {
            /// 嵌套事务，建立保存点
            $sp_name = "SFQ_SAVEPOINT_" . (self::$trans_nested_count - 1);
            
            LOGD("开始执行事务，这是第 " . self::$trans_nested_count . " 层事务，执行 SAVEPOINT $sp_name");
            
            $ret = $this->_conn->real_query("SAVEPOINT $sp_name");
        }
        else {
            LOGE("代码执行到了不该执行的地方");
        }
        
        if ($ret != TRUE) {
            LOGW("开始事务时发生错误：" . $this->_conn->error);
        }
    }
    
    /**
     * 提交事务
     */
    public function commit()
    {    
        $ret = TRUE;
        
        /// 事务嵌套处理
        if (self::$trans_nested_count == 1) {
            /// 第一层事务，提交事务
            LOGD("提交事务，将要被提交的事务是第 " . self::$trans_nested_count . " 层事务，执行 COMMIT");
            
            $ret = $this->_conn->real_query('COMMIT');
        }
        else if (self::$trans_nested_count > 1) {
            /// 嵌套事务，删除保存点
            $sp_name = "SFQ_SAVEPOINT_" . (self::$trans_nested_count - 1);
            
            LOGD("开始执行事务，这是第 " . self::$trans_nested_count . " 层事务，执行 RELEASE SAVEPOINT $sp_name");
            
            $ret = $this->_conn->real_query("RELEASE SAVEPOINT $sp_name");
        }
        else {
            LOGE("代码执行到了不该执行的地方");
        }
        
        if ($ret != TRUE) {
            LOGW("提交事务时发生错误：" . $this->_conn->error);
        }
        
        self::$trans_nested_count--;
    }
    
    /**
     * 事务回滚
     */
    public function rollBack()
    {        
        $ret = TRUE;
        
        /// 事务嵌套处理
        if (self::$trans_nested_count == 1) {
            /// 第一层事务，回滚事务
            LOGD("回滚事务，这是第是第 " . self::$trans_nested_count . " 层事务，执行 ROLLBACK");
            
            $ret = $this->_conn->real_query('ROLLBACK');
        }
        else if (self::$trans_nested_count > 1) {
            /// 嵌套事务，回滚到保存点
            $sp_name = "SFQ_SAVEPOINT_" . (self::$trans_nested_count - 1);
            
            LOGD("回滚事务，这是第 " . self::$trans_nested_count . " 层事务，执行 ROLLBACK TO $sp_name");
            
            $ret = $this->_conn->real_query("ROLLBACK TO $sp_name");
        }
        else {
            LOGE("代码执行到了不该执行的地方");
        }
        
        if ($ret != TRUE) {
            LOGW("回滚事务时发生错误：" . $this->_conn->error);
        }
        
        self::$trans_nested_count--;
    }
}

?>