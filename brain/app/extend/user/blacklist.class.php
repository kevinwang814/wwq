<?php
class Extend_User_Blacklist{

    /**
     * 根据身份证号码或电话号码获取user_id
     * @param type $username
     * @return type
     */
    public function getUseridByUsername($username){
        $sql = "SELECT bu.id FROM suifenqi.b_user as bu"
             . " LEFT JOIN suifenqi.b_user_info_base as buib on buib.user_id = bu.id "
             . " where bu.mobile_num = {$username} or buib.identity_card = {$username}";     
        $data = importModel('User_Blacklist')->query($sql)->find();
        if($data['id']){
            return $data['id'];
        }
        return NULL;
    }
    
    /**
     * 数据总条数
     * @return int
     */
    public function getCount(){
        $sql = "SELECT count(bubl.id) as `count` FROM suifenqi.b_user_blacklist as bubl "
             . " JOIN suifenqi.b_user as bu on bubl.user_id = bu.id "
             . " JOIN suifenqi.b_user_info_base as buib on buib.user_id = bu.id WHERE bubl.status = 'enabled'";
        $data = importModel('User_Blacklist')->query($sql)->find();
        if($data['count']){
            return $data['count'];
        }
        return 0;        
    }
    
    /**
     * 获取列表数据
     * @param type $pageSize
     * @param type $limit
     * @return type
     */
    public function listAll($pageSize,$limit){
        $sql = "SELECT bubl.id,buib.name,bu.mobile_num,buib.identity_card,bubl.update_time,bubl.reason,bubl.status,bubl.admin_id "
             . " FROM suifenqi.b_user_blacklist as bubl"
             . " JOIN suifenqi.b_user as bu on bubl.user_id = bu.id "                 
             . " JOIN suifenqi.b_user_info_base as buib on buib.user_id = bu.id "
             . " WHERE bubl.status = 'enabled' "
             . " ORDER BY bubl.create_time DESC "
             . " limit {$limit},{$pageSize}";
        $data = importModel('User_Blacklist')->query($sql)->findAll();
        if($data){
            return $this ->formatList($data);
        }
        return NULL;
    }
    
    private function formatList($data){
        if(isset($data)){
            foreach ($data as &$blacklistInfo){
                $blacklistInfo['update_time'] = date('Y-m-d H:i:s',$blacklistInfo['update_time']);
            }
            return $data;
        }
    } 
}