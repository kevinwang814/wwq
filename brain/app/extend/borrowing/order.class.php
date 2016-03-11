<?php

class Extend_Borrowing_Order {
  
    /**
     * 根据查询条件获取一个 Borrowing_Order
     * 
     * @param array 查询条件
     * @return array or NULL 返回 Borrowing_Order 信息
     */
    public function getBy($cond) {
        $res = importModel('Borrowing_Order')->getBy($cond);
        if (!$res) {
            return NULL;
        }
        
        return $this->format($res);
    }
    
    
    /**
     * 根据数据需求格式化一个 Borrowing_Order
     * 
     * @param array $order
     * @return array or NULL
     */
    public function format($order){
        $userExtend = importExtend('User');
        $orderStatusMap = C('order_status_map');
        $user = $userExtend->getBy(array('id' => $order['user_id']));
        $userBank = importModel('User_Info_Bank')->getBy(array('id' => $order['user_bank_id']));
        if($user){
            $order['name'] = $user['name'];
            $order['credit_level'] = $user['credit_level'];
            $order['apply_count'] = $user['apply_count'];
            $order['register_date'] = date('Y-m-d', $user['create_time']);
            $order['mobile_num'] = $user['mobile_num'];
        }
        if($userBank){
            $order['bank_name'] = $userBank['bank_name'];
            $order['opening_bank_name'] = $userBank['opening_bank_name'];
            $order['holder_id_card'] = $userBank['holder_id_card'];
            $order['bank_card_number'] = $userBank['bank_card_number'];
        }
        $order['apply_time'] = date('Y-m-d H:i:s', $order['apply_time']);
        $order['update_time'] = date('Y-m-d H:i:s', $order['update_time']);
        if($order['period_type'] == 'monthly'){
            $order['duration'] = "{$order['period_num']}个月";
            $order['loan_way'] = "分期还款";
        }
        if($order['period_type'] == '15d_free'){
            $order['duration'] = "15天";
            $order['loan_way'] = "一次还款";
        }
        if(isset($orderStatusMap[$order['status']])){
            $order['status'] = $orderStatusMap[$order['status']];
        }
        return $order;
    }
    
    /**
     * 根据条件查询 Borrowing_Order 列表
     * 
     * @param array $option 查询条件
     * @return array 返回Borrowing_Order 列表信息
     */
    public function getList($option){
        $res = importModel('Borrowing_Order')->getList($option);
        if (!$res) {
            return NULL;
        }
        
        return $this->formatList($res);
    }
    
    /**
     * 根据数据需求格式化 Borrowing_Order 列表
     * 
     * @param array $orderList
     * @return array
     */
    public function formatList($orderList){
        if(!is_array($orderList)){
            return NULL;
        }
        
        $userExtend = importExtend('User');
        $orderStatusMap = C('order_status_map');
        
        foreach ($orderList as &$order) {
            $user = $userExtend->getBy(array('id' => $order['user_id']));
            $promotion_code = "";
            if($user){
                $order['name'] = $user['name'];
                $order['credit_level'] = $user['credit_level'];
                $order['apply_count'] = $user['apply_count'];
                $promotion_code = $user['invite_code'];
            }
            $order['apply_time'] = date('Y-m-d H:i:s', $order['apply_time']);
            $order['audit_time'] = date('Y-m-d H:i:s', $order['audit_time']);
            $order['update_time'] = date('Y-m-d H:i:s', $order['update_time']);
            if($order['period_type'] == 'monthly'){
                $order['duration'] = "{$order['period_num']}个月";
                $order['loan_way'] = "分期还款";
            }
            if($order['period_type'] == '15d_free'){
                $order['duration'] = "15天";
                $order['loan_way'] = "一次还款";
            }
            if($order['status'] == 'pending'){
                $order['operator'] = "审核";
            }else{
                $order['operator'] = "查看";
            }
            if(isset($orderStatusMap[$order['status']])){
                $order['status'] = $orderStatusMap[$order['status']];
            }
            if(!$order['promotion_code']){
                $order['promotion_code'] = $promotion_code;
            }
        }
        
        return $orderList;
    }
    
    /**
     * 根据参数获取sql
     * @param type $parameter
     * @return type
     */
    public function getConditionSql($parameter){
        $sql = "1=1";
        if($parameter['loan_name']){
            $user_id_str = importExtend('User')->getUserIdByName($parameter['loan_name']);
            $sql .= " and user_id in ({$user_id_str})";
        }
        if($parameter['loan_number']){
            $sql .= " and show_order_id = '{$parameter['loan_number']}'";
        }
        if($parameter['audit_status']){
            $sql .= " and status = '{$parameter['audit_status']}'";
        } 
        if($parameter['loan_way']){
            $sql .= " and period_type = '{$parameter['loan_way']}'";
        }
        $end = time();
        $start = strtotime(date("Y-m-d",strtotime("-1 month")));
        if($parameter['applytime_start']){
            $start = strtotime($parameter['applytime_start']);
        }
        if($parameter['applytime_end']){
            $end = strtotime($parameter['applytime_end']);
        }
        $sql .= " and apply_time between {$start} and {$end}";
        return $sql;
    }
    
    /**
     * 获得财务管理相关的sql
     * @param type $parameter
     * @return type
     */
    public function getFinanceConditionSql($parameter){
        $sql = "1=1";
        if($parameter['loan_name']){
            $user_id_str = importExtend('User')->getUserIdByName($parameter['loan_name']);
            $sql .= " and user_id in ({$user_id_str})";
        }
        if($parameter['mobile_number']){
            $user_id = importExtend('User')->getUserIdByMobileNumber($parameter['mobile_number']);
            $sql .= " and user_id = {$user_id}";
        }
        $end = time();
        $start = strtotime(date("Y-m-d",strtotime("-1 month")));
        if($parameter['audittime_start']){
            $start = strtotime($parameter['audittime_start']);
        }
        if($parameter['audittime_end']){
            $end = strtotime($parameter['audittime_end']);
        }
        $sql .= " and audit_time between {$start} and {$end}";
        return $sql;
    }
}