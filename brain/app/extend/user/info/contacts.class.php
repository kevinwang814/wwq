<?php

class Extend_User_Info_Contacts{
    
    /**
     * 根据$option查询列表
     * @param type $option
     * @return type
     */
    public function getList($option){
        $res = importModel('User_Info_Contacts')->getList($option);
        if (!$res) {
            return NULL;
        }
        return $this->formatList($res);
    }
    
    /**
     * 根据要求格式化family_relation字段
     * @param type $contactsList
     * @return type
     */
    public function formatList($contactsList){
        if(!is_array($contactsList)){
            return NULL;
        }
        foreach($contactsList as &$contacts){
            if($contacts['type'] == 'schoolmate'){
                $contacts["family_relation"] = '同学';
            }else if($contacts['type'] == 'friend'){
                $contacts["family_relation"] = '朋友';
            }else if($contacts['type'] == 'roommate'){
                $contacts["family_relation"] = '室友';
            }
            if($this->existMobileNum($contacts['mobile_num'], $contacts['user_id'])){
                $contacts['mobile_num'] = "<b style='color:blue;'>".$contacts['mobile_num']."</b>";
            }
        }
        return $contactsList;
    }
    
    /**
     * 是否其他用户存在同样电话号码
     * @param type $mobile_num
     * @param type $user_id
     * @return boolean
     */
    private function existMobileNum($mobile_num,$user_id){
        $sql = "SELECT id FROM suifenqi.b_user_info_contacts"
             . " where mobile_num = '{$mobile_num}' and user_id <> {$user_id}";
        $data = importModel('User_Info_Contacts')->query($sql)->find();
        if($data && $data['id']){
            return TRUE;
        }
        return FALSE;
    }
}