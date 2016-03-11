<?php

class Core_Model {

    private $table_name = '';
    private $field = '*';
    private $orderby = '';
    private $groupby = '';
    private $limit = '';
    private $where = '';
    private $data = array();
    private $query_sql = '';  #用query($sql)方法，直接用SQL进行查询。
    private $db_change = false;  #是否进行db切换
    public $db_config_name = 'default'; #默认的使用的数据库
    private $db = NULL;
    private $dbdriver = 'mysqli';

    /**
     * 连接数据库,用户model中可以调用
     * @access protected
     * @return object 原生数据库操作语柄
     */
    protected function conn() {
        // 只有两种情况下才去连接数据库。 1.之前没有数据库连接; 2.需要连接别的MySQL SERVER
        if (!is_object($this->db) || ($this->db_change == true)) {
            $this->db = new Core_Driver_Mysqli($this->db_config_name);
            $this->db_change = false;
        }
        return $this->db;
    }

    /**
     * 生成SELECT类型的SQL语句。
     * @access private
     * @return string 查询sql语句
     */
    private function _read_sql() {
        //可能是model::query('select')，直接接受SQL的查询操作
        if (!$this->query_sql) {
            $_table_name = $this->_get_table_name();
            $_where = empty($this->where) ? '' : ' WHERE ' . $this->where;
            $_orderby = empty($this->orderby) ? '' : ' ORDER BY ' . $this->orderby;
            $_groupby = empty($this->groupby) ? '' : ' GROUP BY ' . $this->groupby;
            $_limit = empty($this->limit) ? '' : ' LIMIT ' . $this->limit;
            $this->db->sql = 'SELECT ' . $this->field . ' FROM ' . $_table_name . $_where . $_groupby . $_orderby . $_limit;
            $this->_clear_var(); //清理使用过的变量
            return $this->db->sql;
        } else {
            $this->db->sql = $this->query_sql;
            $this->query_sql = '';
            return $this->db->sql;
        }
    }

    /**
     * 获取表名
     * @access private
     * @return string 返回表名
     */
    private function _get_table_name() {
        if ($this->table_name == '') {
            throw new Core_Exception('table_name无法确定！');
        }

        return $this->table_name;
    }

    /**
     * 清理使用过的变量
     * @access private
     * @return void
     */
    private function _clear_var() {
        //$this->table_name = '';
        $this->field = '*';
        $this->orderby = '';
        $this->groupby = '';
        $this->limit = '';
        $this->where = '';
        $this->db_change = false;
    }

    /**
     * 查询的表名
     * @param  string $table_name 表名
     * @return string
     */
    public function table($table_name) {
        $this->table_name = $table_name;
        return $this;
    }

    /**
     * 指定使用配置文件中哪一个数据库信息，用于多服务器连接。例如default、primary
     * @param string $db_config_name
     */
    public function dbconfig($db_config_name) {
        // 是否需要重新连接数据了
        if (!empty($this->db_config_name) && ($this->db_config_name != $db_config_name)) {
            $this->db_change = true;
        }
        $this->db_config_name = $db_config_name;

        return $this;
    }

    /**
     * 要查询的数据库字段，也就是SQL中select后的字段列表
     * @param  string $field 要查询的字段列表
     * @return string $this
     */
    public function select($field) {
        $this->field = $field;
        return $this;
    }

    /**
     * SQL中limit，使用方法：model::limit('0,10') 或 model::limit(0,10)
     * @param mixed $limit limit部分或开始部分
     * @param integer $pagecount 每页数目
     * @return string $this
     */
    public function limit($limit, $pagecount = 0) {
        if (!$pagecount) {
            $this->limit = $limit;
        } else {
            $this->limit = $limit . ',' . $pagecount;
        }
        return $this;
    }

    /**
     * 写入数据库的内容(insert|update)
     * @param array $data 要写入数据库的内容。
     * @param array $noquote data中不加引号的字段列表。如array('updated','create_time');
     * @return object $this
     */
    public function set($data, $noquote = array()) {
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                //转义
                $v = $this->escapeString($v);
                if (!in_array($k, $noquote)) {
                    $data[$k] = "'{$v}'";
                }
            }
        } else {
            throw new Core_Exception('model::set($data, $noquote)，第一个和第二个参数都必须是一个数组。');
        }
        $this->data = $data;
        return $this;
    }

    /**
     * SQL中的where条件
     * @param  string||array $where 可以是一个字符串或数组。
     * @param  array $noquote 指定那些字段不加引号引号。如array('updated', 'create_time');
     * @return object $this
     */
    public function where($where, $noquote = array()) {
        //如果是$where是string，则直接返回
        if (is_string($where)) {
            $this->where = $where;
            return $this;
        }

        //生成SQL中where的部分
        if (is_array($where)) {
            $cond = array();
            foreach ($where as $key => $value) {
                if (is_int($key)) {
                    $cond[] = $value;
                    continue;
                }

                if (is_array($value)) {
                    $value = $this->escapeArray($value);
                    if (!in_array($key, $noquote)) {
                        /// 加引号
                        $cond[] = "{$key} IN ('" . join("','", $value) . "')";
                    } else {
                        /// 不加引号
                        $cond[] = "{$key} IN (" . join(",", $value) . ")";
                    }
                    continue;
                }

                if (is_string($value)) {
                    $value = $this->escapeString($value);
                }

                // 对于 int 和 float 类型的值，不需要添加引号
                if (in_array($key, $noquote) || is_int($value) || is_float($value)) {
                    $cond[] = "{$key}={$value}"; //不加引号。
                } else {
                    $cond[] = "{$key}='{$value}'"; //加引号
                }
            }
            $this->where = implode(' AND ', $cond);
            return $this;
        }

        throw new Core_Exception('model::where($where, $noquote) 参数类型错误，$where需要是字符串或数组, $noquote必需是数组');
    }

    /**
     * order by排序
     * @param  string $orderby
     * @return string $this
     */
    public function orderby($orderby) {
        $this->orderby = $orderby;
        return $this;
    }

    /**
     * SQL group by
     * @param string $groupby 分组
     * @return object $this
     */
    public function groupby($groupby) {
        $this->groupby = $groupby;
        return $this;
    }

    /** 返回影响的数据行数。* */
    public function affected_rows() {
        return $this->db->affected_rows();
    }

    /** 返回刚插入的insert_id * */
    public function insert_id() {
        return $this->db->insert_id();
    }

    /** 最后执行的sql语句。 * */
    public function getLastSql() {
        return $this->db->sql;
    }

    /**
     * 转义SQL查询字符
     */
    public function escapeString($str) {
        return $this->conn()->escapeString($str);
    }

    /**
     * 将数组中的值做 SQL 转义
     */
    public function escapeArray($array) {
        foreach ($array as $key => $value) {
            if (is_string($value)) {
                $value = $this->conn()->escapeString($value);
            }
            $array[$key] = $value;
        }
        return $array;
    }

    /**
     * 返回 WHERE 语句的 SQL 字符串
     */
    public function whereSQL() {
        return $this->where;
    }

    /**
     * 获取 SQL 执行时间的统计数据
     */
    public static function getStat() {
        return Core_Driver_Mysqli::$statistics;
    }

    /**
     * 调用数据库db::query方法，如果是SELECT可以后后续操作。
     * @param  string $sql 要查询的SQL或执行commit的SQL等。
     * @return mixed
     */
    public function query($sql) {
        #鉴定是执行查询还是commit提交操作。如果是select，可以有后续操作。
        if (strtolower(substr($sql, 0, 6)) == 'select') {
            $this->query_sql = $sql;
            return $this;
        } else {
            return $this->conn()->query($sql);
        }
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////
// 基础的CURD操作
////////////////////////////////////////////////////////////////////////////////////////////////////////

    /** 写入数据库操作。* */
    public function insert() {
        if (empty($this->data)) {
            throw new Core_Exception('警告：您没有往数据库中写入任何信息。请使用model::set(array $data)指定写入数据库的数据。');
        }

        $_table_name = $this->_get_table_name();
        $_fields = implode(',', array_keys($this->data));
        $_values = implode(',', array_values($this->data));

        //清理使用过的变量
        $this->data = array();

        $this->conn();
        $this->db->sql = 'INSERT INTO ' . $_table_name . " ({$_fields}) VALUES ({$_values})";
        return $this->db->query($this->db->sql);
    }

    /**
     * 以array的方式,返回查询到的一条数据
     * @param string $table_name 表名
     * @return array
     */
    public function find($table_name = '') {
        if ($table_name) {
            $this->table_name = $table_name;
        }
        return $this->conn()->fetch_array($this->_read_sql());
    }

    /**
     * 以array的方式,返回多条查询结果
     * @param string $table_name 表名
     * @return array
     */
    public function findAll($table_name = '') {
        if ($table_name) {
            $this->table_name = $table_name;
        }
        return $this->conn()->fetch_arrays($this->_read_sql());
    }

    /**
     * 以object的方式,返回查询到的一条数据
     * @param string $table_name 表名
     * @return object
     */
    public function findObj($table_name = '') {
        if ($table_name) {
            $this->table_name = $table_name;
        }
        return $this->conn()->fetch_object($this->_read_sql());
    }

    /**
     * 以object的方式,返回查询到的多条数据
     * @param string $table_name 表名
     * @return object
     */
    public function findObjs($table_name = '') {
        if ($table_name) {
            $this->table_name = $table_name;
        }
        return $this->conn()->fetch_objects($this->_read_sql());
    }

    /**
     * 统计数据条数
     * 示例:$m->table('test')->select('id')->where('id<12')->count();
     * @return integer
     */
    public function count() {
        $_table_name = $this->_get_table_name();
        $_where = ($this->where != '') ? ' WHERE ' . $this->where : '';
        $_field = $this->field;

        //清理使用过的变量
        $this->where = '';
        $this->field = '*';

        $this->conn();
        $this->db->sql = 'SELECT count(' . $_field . ') count FROM ' . $_table_name . $_where;
        return $this->db->fetch_object($this->db->sql)->count;
    }

    /**
     * 和findAll()差不多，不过返回的内容中包含不带limit的所有数据。只支持mysql数据库
     * 返回的数据结构：array('data'=>array(....), 'data_count'=>总数据数)
     * @param string $table_name
     * @return array
     */
    public function findPage($table_name = '') {
        if ($table_name) {
            $this->table_name = $table_name;
        }

        if ($this->dbdriver == 'mysql' || $this->dbdriver == 'mysqli') {
            // mysql支持select SQL_CALC_FOUND_ROWS xx from xxx where统计查询的数据数。
            $this->field = 'SQL_CALC_FOUND_ROWS ' . $this->field;
            $ret_data['data'] = $this->findAll();
            $_tmp_sql = $this->db->sql; //本次执行的sql。
            $ret_data['data_count'] = $this->db->fetch_object('SELECT FOUND_ROWS() count')->count;
            $this->db->sql = $_tmp_sql; //让上次的sql作为最后执行的sql语句。
            return $ret_data;
        } else {
            $_table_name = $this->_get_table_name();
            $_where = ($this->where != '') ? ' WHERE ' . $this->where : '';

            $this->conn();
            $this->db->sql = 'SELECT count(*) count FROM ' . $_table_name . $_where;

            $ret_data['data_count'] = $this->db->fetch_object($this->db->sql)->count;
            $ret_data['data'] = $this->findAll();
            return $ret_data;
        }
    }

    /**
     * 更新数据库一行或多行，如果希望更新所有的数据，即无where条件，请将$f置为true，默认false
     * @param boolean $f
     * @return boolean
     */
    public function update($f = false) {
        if (empty($this->data)) {
            throw new Core_Exception('警告：您没有往数据库中写入任何信息。请使用model::set(array $data)指定写入数据库的数据。');
        }

        $_where = '';
        $_table_name = $this->_get_table_name();

        $_set_string = ' SET ';
        $tmp = array();
        foreach ($this->data as $k => $v) {
            $tmp[] = $k . '=' . $v;
        }
        $_set_string .= implode(',', $tmp);

        if ($this->where) {
            $_where = ' WHERE ' . $this->where;
        } else if ($this->where == '' && $f == false) {
            throw new Core_Exception('警告：执行update需要有where条件，似乎你漏掉了where条件，如果您确认不使用where条件，请把使用model::update(true)');
        }

        //清理使用过的变量
        $this->data = array();
        $this->where = '';

        $this->conn();
        $this->db->sql = 'UPDATE ' . $_table_name . $_set_string . $_where;
        return $this->db->query($this->db->sql);
    }

    /**
     * 删除一行或多行，如果希望删除所有行,请将$f置为true，默认false
     * @param boolean $f
     * @return boolean
     */
    public function delete($f = false) {
        $_where = '';
        $_table_name = $this->_get_table_name();

        if ($this->where) {
            $_where = ' WHERE ' . $this->where;
        } else if ($this->where == '' && $f == false) {
            throw new Core_Exception('警告：执行delete需要有where条件，似乎你漏掉了where条件，如果您确认不使用where条件，请把使用model::delete(true)');
        }

        //清理使用过的变量
        $this->where = '';

        $this->conn();
        $this->db->sql = 'DELETE FROM ' . $_table_name . $_where;

        return $this->db->query($this->db->sql);
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////
// 更方便常用的CURD操作
////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     *设置子类的基本信息
     *  
     * @param type $options
     */
    public function setModel($options) {
        $defaultSetting = array(
            'table_name' => '',
            'field' => '*',
            'condition' => '',
            'groupby' => '',
            'orderby' => '',
            'offset' => 0,
            'limit' => 0,
        );

        $setting = array_merge($defaultSetting, $options);
        $this->table_name = $setting['table_name'];
        $this->condition = $setting['condition'];
        $this->groupby = $setting['groupby'];
        $this->orderby = $setting['orderby'];
        $this->offset = $setting['offset'];
        $this->limit = $setting['limit'];   
    }

    /**
     * 插入记录
     * 
     * @param array $data
     * @return int  插入记录的主键
     */
    public function create($data) {
        $this->table($this->table_name)->set($data)->insert();
        return $this->insert_id();
    }

    /**
     * 根据条件获取一行记录
     * 
     * @param array or string $cond
     * @return array
     */
    public function getBy($cond) {
        return $this->table($this->table_name)->where($cond)->find();
    }

    /**
     * 根据配置参数，获取多条记录
     * @param array $options
     * @return array
     */
    public function getList($options = array()) {
        $defaultSetting = array(
            'field' => '*',
            'condition' => '',
            'groupby' => '',
            'orderby' => '',
            'offset' => 0,
            'limit' => 0,
        );
        
        $setting = array_merge($defaultSetting, $options);
        if ($setting['field']) {
            $this->select($setting['field']);
        }
        if ($setting['condition']) {
            $this->where($setting['condition']);
        }
        if ($setting['groupby']) {
            $this->groupby($setting['groupby']);
        }
        if ($setting['orderby']) {
            $this->orderby($setting['orderby']);
        }
        if ($setting['limit']) {
            $this->limit($setting['offset'], $setting['limit']);
        }
        
        return $this->findAll();
    }
    
    /**
     * 根据条件获取count
     * 
     * @param array $cond
     * @return int
     */
    public function getCount($options = array()) {
        $defaultSetting = array(
            'field' => '*',
            'condition' => '',
            'groupby' => '',
            'orderby' => '',
            'offset' => 0,
            'limit' => 0,
        );

        $setting = array_merge($defaultSetting, $options);
        $this->select('COUNT(*) AS count');
        if ($setting['condition']) {
            $this->where($setting['condition']);
        }
        if ($setting['groupby']) {
            $this->groupby($setting['groupby']);
        }
        if ($setting['orderby']) {
            $this->orderby($setting['orderby']);
        }
        if ($setting['limit']) {
            $this->limit($setting['offset'], $setting['limit']);
        }
        
        $data = $this->find();
        return $data['count'];
    }
    
    /**
     * 根据条件更新记录
     * @param array or string $cond
     * @param array $data
     * @return bool
     */
    public function updateBy($cond, $data) {
        return $this->table($this->table_name)->where($cond)->set($data)->update();
    }

    /**
     * 根据条件删除记录
     * 
     * @param array or string $cond
     * @return bool
     */
    public function deleteBy($cond) {
        return $this->table($this->table_name)->where($cond)->delete();
    }
    
    /**
     * 获取一个 MySQL 提供的锁
     * 
     * @param string    锁名字
     * @param float     阻塞时间，如果无法获得锁时，阻塞多长时间后返回
     * @return boolean  成功时返回 TRUE，失败时返回 FALSE
     */
    public function lock($name, $timeout = 0) {
        $name = C("db.{$this->db_config_name}.dbname") . '_' . $name;

        $name_qs = $this->escapeString($name);
        $timeout = (float) $timeout;

        LOGD("尝试获取 SQL 锁“{$name}”，超时时间为“{$timeout}”秒");

        $sql = "SELECT GET_LOCK('${name_qs}', ${timeout})";

        $result = $this->query($sql)->find();

        if ($result) {
            $ret = current($result);
            if ($ret == 1) {
                LOGD("成功获取 SQL 锁“{$name}”");
                return TRUE;
            } else {
                LOGW("无法获取 SQL 锁“{$name}”，返回值是 {$ret}");
                return FALSE;
            }
        } else {
            LOGW("无法获取 SQL 锁“{$name}”，返回结果是：" . var_export($result, TRUE));
            return FALSE;
        }
    }

    /**
     * 释放一个由 MySQL 提供的锁
     * 
     * @param string    锁名字
     * @return boolean  成功时返回 TRUE，失败时返回 FALSE
     */
    public function unlock($name) {
        $name = C("db.{$this->db_config_name}.dbname") . '_' . $name;

        $name_qs = $this->escapeString($name);

        LOGD("尝试释放 SQL 锁“{$name}”");

        $sql = "SELECT RELEASE_LOCK('${name_qs}')";

        $result = $this->query($sql)->find();

        if ($result) {
            $ret = current($result);
            if ($ret == 1) {
                LOGD("成功释放 SQL 锁“{$name}”");
                return TRUE;
            } else {
                LOGW("无法释放 SQL 锁“{$name}”，返回值是 {$ret}");
                return FALSE;
            }
        } else {
            LOGW("无法释放 SQL 锁“{$name}”，返回结果是：" . var_export($result, TRUE));
            return FALSE;
        }
    }

    /**
     * 开始一个事务
     */
    public function beginTransaction() {
        $this->conn()->beginTransaction();
    }

    /**
     * 提交事务
     */
    public function commit() {
        $this->conn()->commit();
    }

    /**
     * 事务回滚
     */
    public function rollBack() {
        $this->conn()->rollBack();
    }

}

?>