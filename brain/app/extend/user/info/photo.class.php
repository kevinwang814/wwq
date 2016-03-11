<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of photo
 *
 * @author xiaojie
 */
class Extend_User_Info_Photo {
    
    /**
     * 根据$option查询列表
     * @param type $option
     * @return type
     */
    public function getList($option){
        $res = importModel('User_Info_Photo')->getList($option);
        if (!$res) {
            return NULL;
        }
        return $this->formatList($res);
    }
    
    /**
     * 返回中文标示的列表
     * @param type $photoList
     * @return type
     */
    public function formatList($photoList){
        if(!is_array($photoList)){
            return NULL;
        }
        foreach ($photoList as &$photo){
            if($photo['type'] == "personal"){
                $photo['infoDetail'] = "个人审核照";
            }else if($photo['type'] == "id_card_a"){
                $photo['infoDetail'] = "身份证正面";
            }else if($photo['type'] == "id_card_b"){
                $photo['infoDetail'] = "身份证反面";
            }else if($photo['type'] == "student_id_card"){
                $photo['infoDetail'] = "学生证";
            }else if($photo['type'] == "campus_one_card"){
                $photo['infoDetail'] = "校园一卡通";
            }else if($photo['type'] == "residence_booklet"){
                $photo['infoDetail'] = "户口簿";
            }else if($photo['type'] == "driver_license"){
                $photo['infoDetail'] = "驾照";
            }else if($photo['type'] == "bank_statement"){
                $photo['infoDetail'] = "银行流水";
            }else if($photo['type'] == "alipay_statement"){
                $photo['infoDetail'] = "支付宝流水";
            }else if($photo['type'] == "parent_id_card"){
                $photo['infoDetail'] = "家长身份证";
            }else if($photo['type'] == "roommate_id_card"){
                $photo['infoDetail'] = "室友身份证";
            }else if($photo['type'] == "award_cert"){
                $photo['infoDetail'] = "获奖证明";
            }else if($photo['type'] == "ss_card"){
                $photo['infoDetail'] = "社保卡";
            }else if($photo['type'] == "credit_card"){
                $photo['infoDetail'] = "信用卡";
            }else if($photo['type'] == "student_id_card_r"){
                $photo['infoDetail'] = "学生证注册页面";
            }else if($photo['type'] == "video"){
                $qiniuRequestExtend = importExtend('Qiniu_Request');
                $photo['infoDetail'] = "视频验证";
                $photo['videoUrl'] = "";
                $photo['imgUrl'] = "";
                if($photo['hash']){
                    $hash_array = explode(",",$photo['hash']);
                    $photo['imgUrl'] = $qiniuRequestExtend ->getDownloadToken($hash_array[0],1);
                    if(count($hash_array)>1){
                        $photo['videoUrl'] = $qiniuRequestExtend ->getDownloadToken($hash_array[1]);
                    }
                }
            }
        }
        return $photoList;
    }
}