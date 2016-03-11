<?php

class Extend_User {
    
    /**
     * 根据查询条件获取一个 User
     * 
     * @param array 查询条件
     * @return array or NULL 返回 User 信息
     */
    public function getBy($cond) {
        $res = importModel('User')->getBy($cond);
        if (!$res) {
            return NULL;
        }

        return $this->format($res);
    }

    
    /**
     * 根据数据需求格式化一个 User
     * 
     * @param array $user
     * @return array or NULL
     */
    public function format($user){
        if(!is_array($user)){
            return NULL;
        }
        
        $userInfoBase = importModel('User_Info_Base')->getBy(array('user_id' => $user['id']));
        if($userInfoBase){
            $user['name'] = $userInfoBase['name'];
        }
        return $user;
    }
    
    /**
     * 根据用户名称模糊查找user_id
     * @param type $name
     * @return type
     */
    public function getUserIdByName($name){
        if(!$name){
            return "0";
        }
        $sql = "SELECT user_id FROM suifenqi.b_user_info_base where name like '%{$name}%'";
        $data =importModel('User')->query($sql)->findAll();
        if (!empty($data) && isset($data)) {
            $user_id_str = "";
            foreach ($data as $value) {
                if($value['user_id']){
                    $user_id_str .= "," . $value['user_id'];
                }
            }
            $user_id_str = substr($user_id_str, 1);
            return $user_id_str;
        }
        return "0";
    }
    
    /**
     * 根据手机号码获得user_id
     * @param type $mobile_number
     * @return type
     */
    public function getUserIdByMobileNumber($mobile_number){
        if(!$mobile_number){
            return 0;
        }
        $sql = "SELECT id FROM suifenqi.b_user where mobile_num = '{$mobile_number}'";
        $data =importModel('User')->query($sql)->find();
        if ($data['id']) {
            return $data['id'];
        }
        return 0;        
    }
    
    /**
     * 根据参数获取Listsql
     * @param type $parameter
     * @return type
     */
    private function getConditionListSql($parameter){
        $sql = "SELECT bu.id,bu.mobile_num,buib.name,buib.gender,buib.identity_card,buie.college,"
             . " (year(now())-year(substr(buib.identity_card,7,8))) AS age,FROM_UNIXTIME(bu.create_time) as create_time"
             . " FROM suifenqi.b_user AS bu "
             . " JOIN suifenqi.b_user_info_base AS buib on bu.id = buib.user_id "
             . " LEFT JOIN suifenqi.b_user_info_edu AS buie on bu.id = buie.user_id"
             . " WHERE 1=1";
        if($parameter['user_name']){
            $user_id_str = $this->getUserIdByName($parameter['user_name']);
            $sql .= " and bu.id in ({$user_id_str})";
        }
        if($parameter['mobile_number']){
            $sql .= " and bu.mobile_num = '{$parameter['mobile_number']}'";
        }
        if($parameter['identity_card']){
            $sql .= " and buib.identity_card = '{$parameter['identity_card']}'";
        }
        $sql .= " ORDER BY bu.id DESC LIMIT {$parameter['offset']},{$parameter['limit']}";
        return $sql;
    }
    
    /**
     * 根据参数获取Countsql
     * @param type $parameter
     * @return type
     */
    private function getConditionCountSql($parameter){
        $sql = "SELECT count(bu.id) as `count` FROM suifenqi.b_user AS bu "
             . " JOIN suifenqi.b_user_info_base AS buib on bu.id = buib.user_id "
             . " LEFT JOIN suifenqi.b_user_info_edu AS buie on bu.id = buie.user_id"
             . " WHERE 1=1";
        if($parameter['user_name']){
            $user_id_str = $this->getUserIdByName($parameter['user_name']);
            $sql .= " and bu.id in ({$user_id_str})";
        }
        if($parameter['mobile_number']){
            $sql .= " and bu.mobile_num = '{$parameter['mobile_number']}'";
        }
        if($parameter['identity_card']){
            $sql .= " and buib.identity_card = '{$parameter['identity_card']}'";
        }
        return $sql;
    }    
    
    /**
     * 返回数据
     * @param type $parameter
     * @return type
     */
    public function getUserInfoList($parameter){
        $sql = $this->getConditionListSql($parameter);
        $data = importModel('User')->query($sql)->findAll();
        if ($data) {
            return $data;
        }
        return NULL;
    }
    
    /**
     *  返回行数
     * @param type $parameter
     * @return int
     */
    public function getUserInfoCount($parameter){
        $sql = $this->getConditionCountSql($parameter);
        $data = importModel('User')->query($sql)->find();
        if ($data['count']) {
            return $data['count'];
        }
        return 0;        
    }
    
}