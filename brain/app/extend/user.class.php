<?php

class Extend_User {
    
    /**
     * 根据查询条件获取一个 User
     * 
     * @param array 查询条件
     * @return array or NULL 返回 User 信息
     */
    public function getInfo($id) {
        $sql = "select id,name,mobile_num,email from user";
        $userInfo = importModel('User')->query($sql)->find();
        if (!$userInfo) {
            return NULL;
        }

        return $userInfo;
    }



    
}