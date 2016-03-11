<?php

class Extend_Borrowing_Bill {
    
    /**
     * 根据条件查询 Bill 列表
     * 
     * @param array $option 查询条件
     * @return array 返回Borrowing_Order 和 Bill 列表信息
     */
    public function getList($option){
        $res = importModel('Bill')->getList($option);
        if (!$res) {
            return NULL;
        }
        
        return $this->formatList($res);
    }
    
    /**
     * 格式化账单信息,根据order信息
     * @param type $billList
     * @return type
     */
    public function formatList($billList){
        if(!is_array($billList)){
            return NULL;
        }
        
        $borrowingOrderExtend = importExtend('Borrowing_Order');
        
        foreach ($billList as &$bill){
            $borrowingOrder = $borrowingOrderExtend->getBy(array('id' => $bill['order_id']));
            if($borrowingOrder){
                $bill['show_order_id'] = $borrowingOrder['show_order_id'];
                $bill['name'] = $borrowingOrder['name'];
                $bill['apply_money'] = $borrowingOrder['apply_money'];
                $bill['audit_money'] = $borrowingOrder['audit_money'];
                $bill['actual_money'] = $borrowingOrder['actual_money'];
                $bill['period_num'] = $borrowingOrder['period_num'];
            }
            $bill['overdue_amount'] = 0;
            if($bill['status'] == 'settled'){
                $bill['statusCh'] = '已出账';
            }else if($bill['status'] == 'unsettled'){
                $bill['statusCh'] = '未出账';
            }else if($bill['status'] == 'repaying'){
                $bill['statusCh'] = '还款中';
            }else if($bill['status'] == 'unfinished'){
                $bill['statusCh'] = '未还清';
            }else if($bill['status'] == 'overdue'){
                $bill['statusCh'] = '已逾期';
                $bill['overdue_amount'] = round($bill['principal'] + $bill['interest'] - $bill['repaid_principal'] - $bill['repaid_interest'],2);
            }else if($bill['status'] == 'closed'){
                $bill['statusCh'] = '已结清';
            }else{
                $bill['statusCh'] = $bill['status'];
            }
            if($bill['is_repaying'] == 1){
                $bill['is_repaying'] = '是';
            }else{
                $bill['is_repaying'] = '否';
            }
        }
        return $billList;
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
        if($parameter['has_evidence']){
            $sql .= " and is_repaying = {$parameter['has_evidence']}";
        }
        $end = time();
        $start = strtotime(date("Y-m-d",strtotime("-6 month")));
        if($parameter['audittime_start']){
            $start = strtotime($parameter['audittime_start']);
        }
        if($parameter['audittime_end']){
            $end = strtotime($parameter['audittime_end']);
        }
        $sql .= " and create_time between {$start} and {$end}";
        return $sql;
    }    
    
}