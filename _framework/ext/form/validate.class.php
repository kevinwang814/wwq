<?php

class Ext_Form_Validate
{
    private $_errorMessage = array();
    private $_rules = array();
    private $_elements;
    // 是否完全检查
    protected $complete_check = true;

    function __construct($data)
    {
        $this->_elements = $this->trimdata($data);
    }

    /**
     * 遇到第一个错误便返回
     */
    public function first_error_only()
    {
        $this->complete_check = false;
    }

    /**
     * 执行所有验证规则,收集所有错误
     */
    public function show_all_errors()
    {
        $this->complete_check = true;
    }

    /**
     * 去掉数据两边的空格
     * 
     * @fields array/string
     * @return array /string
     */
    private function trimdata($fields)
    {
        if(is_array($fields))
        {
            foreach($fields as $key => $value)
            {
                $fields[$key] = $this->trimdata($value);
            }
            return $fields;
        }
        else
        {
            return trim($fields);
        }
    }

    /**
     * 添加验证条件
     * 
     *   $key       => 表单字段名
     *   $message   => 错误时返回消息
     *   $method    => 验证方法
     *   $parameter => 附加参数
     * 
     *   $form->addrule('username','用户名不能为空','not_empty');
     */
    function addrule($key, $message, $method, $parameter = null)
    {
        $rule = array(
	    'key' => $key,
            'message' => $message,
            'method' => $method,
            'parameter' => $parameter,
        );
        $this->_rules[] = $rule;
    }

    /**
     * 验证函数
     * 
     * @return true /false
     */
    function is_valid()
    {
        return $this->_validate($this->_elements);
    }

    private function _validate($data)
    {
        if(!is_array($data))
        {
            throw new Core_Exception('验证数据只支持数据结构');
        }

        $rules = $this->_rules;
        $is_valid = true;

        foreach($rules as $rule)
        {
            $name = $rule['key'];
            $method = $rule['method'];
            $parameter = $rule['parameter'];
            $message = $rule['message'];

            $vdata = '';
            if(is_array($name))
            {
                $vdata = array();
                foreach($name as $nameone)
                {
                    $vdata[] = $data[$nameone];
                }
            }
            else
            {	 
            	(isset($data[$name])) ? $vdata = $data[$name] : $vdata = null;
            }

            $check = $this->$method($vdata, $parameter);

            if(!$check)
            {
                $is_valid = false;
                if(is_array($name))
                {
                    $errorname = current($name);
                }
                else
                {
                    $errorname = $name;
                }
                $this->_errorMessage[$errorname][] = $message;
                // 如果设置不进行完全检查,则发现第一个错误后跳出最外层循环
                if(!$this->complete_check)
                {
                    return $is_valid;
                }
            }
        }
        return $is_valid;
    }

    /**
     * 返回错误信息
     * 
     * @return array 
     */
    function errorMessage()
    {
        return $this->_errorMessage;
    }
    
    /**
     * 返回字符串格式的错误信息
     * 
     * @return string   错误信息
     */
    function errorString() {
        $str = '';
        foreach ($this->_errorMessage as $error) {
            $str .= join('；', $error) . '。';
        }
        
        return $str;
    }

    /**
     * 验证不为空
     */
    private function not_empty($value, $parameter)
    {
        if(IS_ARRAY($value))
        {
            $check = false;
            foreach($value as $one)
            {
                if(trim($one) != "")
                {
                    $check = true;
                }
            }
            return $check;
        }
        else
        {
            if($value == "")
            {
                return false;
            }
            else
            {
                return true;
            }
        }
    }

    /**
     * 验证是邮件
     * 
     * @param string    邮件地址
     * @param string    正则表达式的分隔符，该分隔符将被传递给 preg_split 函数，以便将输入的 value 按分隔符拆分成数组
     */
    private function is_email($value, $parameter)
    {
        $emails = array($value);
        
        if ($parameter) {
            $emails = preg_split($parameter, $value);
            $emails = array_filter($emails);
        }
        
        foreach ($emails as $email) {
            if (!preg_match("/^[a-z0-9]+([._\-]*[a-z0-9])*@([-a-z0-9]*[a-z0-9]+.){2,63}[a-z0-9]+$/i", $email)) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * 验证是手机号码
     * 
     * @param string    手机号码
     * @param string    正则表达式的分隔符，该分隔符将被传递给 preg_split 函数，以便将输入的 value 按分隔符拆分成数组
     */
    private function is_mobile($value, $parameter)
    {
        $mobiles = array($value);
        
        if ($parameter) {
            $mobiles = preg_split($parameter, $value);
        }
        
        foreach ($mobiles as $mobile) {
            $mobile = trim($mobile);
            if (!preg_match("/^1[3-5,7-8][0-9]{9}$/i", $mobile)) {
                return false;
            }
        }
        
        return true;
    }
    

    /**
     * 验证最小值
     */
    private function min($value, $parameter)
    {
        if($value >= $parameter)
        {
            return true;
        }
        return false;
    }

    /**
     * 验证最大值
     */
    private function max($value, $parameter)
    {
        if($value <= $parameter)
        {
            return true;
        }
        return false;
    }

    /**
     * 验证不等于
     */
    private function not($value, $parameter)
    {
        if($value === $parameter)
        {
            return true;
        }
        return false;
    }

    /**
     * 验证最低长度
     */
    private function min_length($value, $parameter)
    {
        //$length = ( strlen($value) + mb_strlen($value, 'UTF8') ) / 2; //计算占位符
        $length = mb_strlen($value, 'utf-8'); //按字符计算长度，而不是按字节
        if($length >= $parameter)
        {
            return true;
        }
        return false;
    }

    /**
     * 验证最大长度
     */
    private function max_length($value, $parameter)
    {
        //$length = ( strlen($value) + mb_strlen($value, 'UTF8') ) / 2; //计算占位符
        $length = mb_strlen($value, 'utf-8'); //按字符计算长度，而不是按字节
        if($length <= $parameter)
        {
            return true;
        }
        return false;
    }

    /**
     * 验证相等
     */
    private function equal($value, $parameter)
    {
        if($value == $parameter)
        {
            return true;
        }
        return false;
    }

    /**
     * 是否唯一
     * 
     * @return boolean 
     */
    private function only($value, $parameter)
    {
        $table = $parameter['0'];
        $field = $parameter['1'];
        $model = new Core_Model();
        if($table != "" && $field != "")
        {
            $result = $model->table($table)->select('COUNT(*) AS count')->where(array($field=>$value))->find();
            if($result['count'])
            {
                return false;
            }
            return true;
        }
        return false;
    }
    
    /**
     * 是否存在 
     * 
     * @return boolean 
     */
    private function exist($value, $parameter)
    {
        $table = $parameter['0'];
        $field = $parameter['1'];
        $model = new Core_Model();
        if($table != "" && $field != "")
        {
            $result = $model->table($table)->select('COUNT(*) AS count')->where(array($field=>$value))->find();
            if($result['count'])
            {
                return true;
            }
        }
        return false;
    }
    
    /**
     * 是否在设置的值内
     * 
     * @param mixed $value 
     * @return boolean 
     */
    private function is_in($value, $parameter)
    {
        if (in_array($value, $parameter)) {
            return true;
        }
        return false;
    }

    /**
     * 是否是字母、数字加下划线
     * 
     * @param mixed $value 
     * @return boolean 
     */
    private function is_alnumu($value, $parameter)
    {
        return preg_match('/[^a-zA-Z0-9_]/', $value) == 0;
    }

    /**
     * 是否是数字
     * 
     * @param mixed $value 
     * @return boolean 
     */
    private function is_numeric($value, $parameter)
    {
        if(is_numeric($value))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * 是否是 IP 地址
     * 
     * @param string    IP 地址
     * @param string    正则表达式的分隔符，该分隔符将被传递给 preg_split 函数，以便将输入的 value 按分隔符拆分成数组
     */
    private function is_ip($value, $parameter) {
        $ips = array($value);
        
        if ($parameter != '') {
            $ips = preg_split($parameter, $value);
            $ips = array_filter($ips);
        }
        
        
        foreach ($ips as $ip) {
            if (!preg_match('/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}/', $ip)) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * 是否是 URL
     */
    private function is_url($value,$parameter)  {
        if (preg_match("/^http[s]?:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"])*$/", $value)) {
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * 是否是日期 有问题比如2015-9 能验证通过
     * /// FIXME: 用 strftime 做更严格的检查
     */
    private function is_date($value, $parameter) {
        if (strtotime($value) === false) {
            return false;
        }
        else {
            return true;
        }
    }
    
    /**
     * 是否是时间
     */
    private function is_time($value, $parameter) {
        $t = explode(':', $value);
        
        if (count($t) != 3) {
            return false;
        }
        
        $hour = (int)$t[0];
        $min = (int)$t[1];
        $sec = (int)$t[2];
        
       
        if ($hour < 0 || $hour > 23) {
            return false;
        }
        else if ($min < 0 || $min > 59) {
            return false;
        }
        else if ($sec < 0 || $sec > 59) {
            return false;
        }
        else {
            return true;
        }
    }
    
    
    /**
     * 是否是金钱
     */
    private function is_money($value, $parameter)
    {
        if(is_numeric($value) && preg_match("/^[0-9]{1,9}(\.[0-9]{1,2})?$/", $value))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * 密码是否符合强度要求
     * 
     * @param string 输入的密码
     * @param string 强度规则，规则列表为：
     *                  8NC => 至少 8 位，包含数字和字符（8=长度，N=Number，C=Char）
     */
    private function password_strenth($value, $parameter) {
        switch (trim(strtoupper($parameter))) {
            case '8NC':
                /// 长度至少 8 位，包含数字和字符
                if (strlen($value) < 8) {
                    return false;
                }
                if (!preg_match('/[0-9]+/', $value) || !preg_match('/[^0-9]+/', $value)) {
                    return false;
                }
                
                break;
                
            default: 
                throw(new Core_Exception("不支持此种类型的密码强度检查：`$parameter'"));
                return false;
        }
        
        return true;
    }
    
    private function mbstrlen($value, $parameter){
        if (mb_strlen($value, 'UTF-8')>$parameter) {
            return FALSE;
        }

        return TRUE;
    }
    
    /**
     * 是否包含某个单词
     */
    private function without_word($value, $parameter)
    {
        if(stristr($value,$parameter))
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
    /**
     * 是否包含某个单词
     */
    private function musthave_word($value, $parameter)
    {
        if(is_array($parameter)) {
            foreach($parameter as $one) {
                if(stristr($value,$one))
                {
                    return true;
                }
            }
            return false;
        }else {
           if (stristr($value,$parameter)) { return true; } else { return false; }
        }
    }
    
    /**
     * 是否有违禁词
     */
    private function badword($value, $parameter)
    {
        $value = str_replace(" ", "", $value);
        $check = Extend_User :: CheckName($value);
        if(!$check)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * 验证是邮件
     */
    private function check_captcha($value, $parameter)
    {
        if(md5(strtolower($value)) == $_SESSION['captcha']['string'])
        {
            return true;
        }
        return false;
    }

    private function captcha_web($value, $parameter)
    {
        $captcha = new Ext_Captcha();
        if($captcha->check($value))
        {
            return true;
        }
        return false;
        /*if(md5(strtolower($value)) == $_SESSION['captcha']['string'])
        {
            return true;
        }
        return false;*/
    }
        
    
    /**
     * 验证最后一个REGION
     */
    private function last_region($value, $parameter)
    {
        $regionExtend = importExtend('Region');
        $re = $regionExtend->checkIfLast($value);
        if($re)
        {
            return true;
        }
        return false;
    }
    
    
}
