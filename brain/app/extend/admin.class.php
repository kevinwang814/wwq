<?php

class Extend_Admin {
    
    /**
     * 根据查询条件获取一个 User
     * 
     * @param array 查询条件
     * @return array or NULL 返回 User 信息
     */
    public function getBy($cond) {
        $res = importModel('admin')->getBy($cond);
        if (!$res) {
            return NULL;
        }

        return $res;
    }
    
    
    /**
     * 检查用户是否可以登录
     * 
     * @param string    注册手机号
     * @param string    明文密码
     * @return mixed    可以登录返回用户信息数组，不能登录返回 false
     */
    public function verify($mobile_num, $password) {
        $hash = $this->encrypt($password);
        $cond = array('mobile_num' => $mobile_num, 'password' => $hash);
        $user = importModel('Admin')->getBy($cond);
        if(!$user){
            return FALSE;
        }
        
        return $user;
    }
    
    /**
     * 加密管理员密码
     * 
     * @param string    明文密码
     * @return string   加密后的密码
     */
    private function encrypt($password) {
        return hash('sha256', C('salt') . $password);
    }
    
}