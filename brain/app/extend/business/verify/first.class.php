<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of first
 *
 * @author xiaojie
 */
class Extend_Business_Verify_First {
   
    /**
     * 审核通过
     * @param type $parameters
     * @return boolean
     */
    public function pass($parameters){
        $audit_money = $parameters['audit_money'];
        // 当审核金额和用户申请金额不同时
        if($audit_money > 0){
            $time = time();
            $actual_money = $parameters['actual_money'];
            $period_type = $parameters['period_type'];
            $period_num = $parameters['period_num'];
            $order_id = $parameters['order_id'];
            $user_id = $parameters['user_id'];
            $conditionArray = array(
                'status' => 'approved',
                'audit_time' => $time,
                'update_time' => $time
            );            
            $borrowingCalcInfo = importModel('Borrowing_Calc')->getBy(array(
                'period_num' => $period_num,
                'apply_money' => $audit_money,
                'period_type' => $period_type)
            );
            if($borrowingCalcInfo){
                $conditionArray['audit_money'] = $audit_money;
                $conditionArray['actual_money'] = $borrowingCalcInfo['actual_money'];
                $conditionArray['poundage'] = $borrowingCalcInfo['poundage'];
                $conditionArray['interest_rate'] = $borrowingCalcInfo['interest_rate'];
                $actual_money = $borrowingCalcInfo['actual_money'];
            }               

            if(importModel('Borrowing_Order')->updateBy(array('id' => $order_id),$conditionArray)){                
                // timeline流程更新
                $timelineFieldData = array(
                    'order_id' => $order_id,
                    'user_id' => $user_id,
                    'type' => 'normal',
                    'content' => '成功申请了' .$actual_money. '元借款，分' . $period_num . '期还',
                    'create_time' => $time
                );
                importModel('Borrowing_Timeline')->create($timelineFieldData);
                // 清空补件状态
                importModel('Rfe')->updateBy(array('user_id' => $user_id), array('is_checked' => 0));
                return TRUE;
            }            
        }
        return FALSE;
    }
    
    /**
     * 拒绝订单
     * @param type $parameters
     * @return boolean
     */
    public function rejected($parameters){
        $time = time();
        $order_id = $parameters['order_id'];
        $user_id = $parameters['user_id'];        
        if(importModel('Borrowing_Order')->updateBy(array('id' => $order_id),
            array('status' => 'rejected','audit_time' => $time,'update_time' => $time))){
            // 拒绝后,补件资料清空
            importModel('Rfe')->updateBy(array('user_id' => $user_id), array('is_checked' => 0));
            return TRUE;
        }
        return FALSE;
    }
    
    /**
     * 补件操作
     * @param type $parameters
     * @return boolean
     */
    public function rfe($parameters){
        $time = time();
        $order_id = $parameters['order_id'];
        $user_id = $parameters['user_id'];
        $rfe_count = $parameters['rfe_count'];
        $rfeString = $parameters['rfeString'];
        $rfe_count = $rfe_count + 1;
        if(importModel('Borrowing_Order')->updateBy(array('id' => $order_id), array('status' => 'rfe',
            'is_reaudit' => 1,'audit_time' => $time,'update_time' => $time,'rfe_count' => $rfe_count))){        
            // 保存rfe业务逻辑
            $rfeList = explode(",",$rfeString);
            if(isset($rfeList) && is_array($rfeList)){
                $legalPhotoType = array('personal', 'id_card_a', 'id_card_b', 'student_id_card', 'student_id_card_r',
                                        'campus_one_card','residence_booklet', 'driver_license', 'bank_statement',
                                        'alipay_statement','parent_id_card','roommate_id_card', 'award_cert','ss_card',
                                        'credit_card','video');
                $legalEduType = array('college', 'edu_background', 'edu_length', 'enroll_time', 'major', 'dorm_num',
                                    'room_num','chis_name_psd');
                $legalContactsType = array('family', 'schoolmate', 'friend', 'roommate');
                $legalBaseType = array('name', 'gender', 'email', 'home_address','native_place','identity_card');
                $legalBankType = array('holder_id_card', 'bank_name', 'opening_bank_name', 'bank_card_number',
                                       'holder_mobile_num','bank_card_a');
                foreach ($rfeList as $value) {
                    $valueList = explode(":", $value);
                    $item = $valueList[0];
                    $remark = $valueList[1];
                    $type = '';
                    $copy = '';
                    if(in_array($item, $legalPhotoType)){
                        $type = 'photo';
                        $userInfoPhoto = importModel('User_Info_Photo')->getBy(
                                array(
                                    'user_id' => $user_id,
                                    'type' => $item
                                ));
                        $copy = $userInfoPhoto['hash'];
                    }else if (in_array($item, $legalEduType)) {
                        $type = 'edu';
                    }else if (in_array($item, $legalContactsType)) {
                        $type = 'contacts';
                    }else if (in_array($item, $legalBaseType)) {
                        $type = 'base';
                    }else if (in_array($item, $legalBankType)) {
                        $type = 'bank';
                    }
                    $fieldData = array(
                        'type' => $type,
                        'item' => $item,
                        'copy' => $copy,
                        'remark' => $remark,
                        'is_checked' => 1,
                        'user_id' => $user_id,
                        'create_time' => $time,
                        'update_time' => $time
                    );
                    importModel("Rfe")->create($fieldData);
                }
            }
            return TRUE;
        }
        return FALSE;
    }
}
