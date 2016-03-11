<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bank
 *
 * @author xiaojie
 */
class Extend_User_Info_Bank {
    
    /**
     * 获取银行信息
     * @param type $user_bank_id
     * @return int
     */
    public function getBy($user_bank_id){
        $userBankInfo = importModel('User_Info_Bank')->getBy(array('id' => $user_bank_id));
        return $this->format($userBankInfo);
    }
    
    /**
     * 格式化数据
     * @param type $userBankInfo
     * @return int
     */
    private function format($userBankInfo){
        if(!$userBankInfo){
            return NULL;
        }
        // 是否是指定的银行卡
        if($userBankInfo['verifiable'] < 1 && $userBankInfo['bank_card_a']){
            $imgHost = C('img_host');
            $userBankInfo['bank_card_a'] = "http://{$imgHost}/image/user_info/width_480/"  
                                         . intval($userBankInfo['user_id']/5000).'/'.$userBankInfo['bank_card_a'].".jpg";
        }
        // 获取是否绑定信息
        $userInfoBankBindInfo = importModel('User_Info_Bank_Bind') -> getBy(
                array('user_bank_id' => $userBankInfo['id'],'plat_type' => 'liandongyoushi')
            );
        if($userInfoBankBindInfo && $userInfoBankBindInfo['bind_status'] == 'success'){
          $userBankInfo['bind_status_ch'] = '已验证';
          $userBankInfo['bind_status'] = 1;
        }else{
          $userBankInfo['bind_status_ch'] = '未验证';
          $userBankInfo['bind_status'] = 0;
        }
        return $userBankInfo;
    }
    
    /**
     * 根据user_id查询银行信息
     * @param type $user_id
     * @return type
     */
    public function getList($user_id){
        $userBankInfoList = importModel("User_Info_Bank")->getList(array('condition' => array('user_id' => $user_id)));
        if(!empty($userBankInfoList) && isset($userBankInfoList)){
            foreach ($userBankInfoList as &$userBankInfo){
                $userBankInfo = $this->format($userBankInfo);
            }
        }
        return $userBankInfoList;
    }
    
}
