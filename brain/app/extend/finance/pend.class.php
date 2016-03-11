<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pend
 *
 * @author xiaojie
 */
class Extend_Finance_Pend {
    
    /**
     * 放款操作
     * @param type $orderInfo
     * @return boolean
     */
    public function issue($orderInfo){
        $time = time();
        $repayMoney = $orderInfo['audit_money'];
        if(importModel('Borrowing_Order')->updateBy(array('id' => $orderInfo['id']),
                array('status' => 'issued','loan_time' => $time,'update_time' => $time))){
            // 判断审核金额
            if($repayMoney <= 0){
                $repayMoney = $orderInfo['apply_money'];
            }
            if($orderInfo['period_type'] == '15d_free'){
                $fieldData = array(
                    'user_id' => $orderInfo['user_id'],
                    'order_id' => $orderInfo['id'],
                    'order_type' => 'borrowing',
                    'bill_type' => $orderInfo['period_type'],
                    'sequence' => 1,
                    'status' => 'settled',
                    'overdue_date' => date('Y-m-d', strtotime(date('Y-m-d', $time). " +15 days")),
                    'repay_money' => $repayMoney,
                    'principal' => $orderInfo['actual_money'] + $orderInfo['poundage'],
                    'interest' => 0,
                    'create_time' => $time,
                    'update_time' => $time,
                );
                importModel('Bill')->create($fieldData);
            }else{
                // 获取计算利率值
                $borrowingCalcInfo = importModel('Borrowing_Calc')->getBy(array(
                    'period_num' => $orderInfo['period_num'],
                    'apply_money' => $repayMoney,
                    'period_type' => 'monthly'
                        )
                    );
                if($borrowingCalcInfo){
                    $period_num = $orderInfo['period_num'];
                    $principal = round($repayMoney / $period_num, 2);
                    $interest = $borrowingCalcInfo['interest'];
                    for ($index = 1; $index <= $period_num; $index++) {
                        $fieldData = array(
                            'user_id' => $orderInfo['user_id'],
                            'order_id' => $orderInfo['id'],
                            'order_type' => 'borrowing',
                            'bill_type' => $orderInfo['period_type'],
                            'sequence' => $index,
                            'status' => 'unsettled',
                            'overdue_date' => date('Y-m-d', strtotime(date('Y-m-d', $time) . " +{$index} month")),
                            'repay_money' => $borrowingCalcInfo['repay_money'],
                            'principal' => $principal,
                            'interest' => $interest,
                            'create_time' => $time,
                            'update_time' => $time,
                        );
                        if($index == 1){
                            $fieldData['status'] = 'settled';
                        }
                        importModel('Bill')->create($fieldData);
                    }
                }
            }
            // 提交ticket工作流
            $ticketFieldData = array(
                'ticket_type' => '',
                'order_id' => $orderInfo['id'],
                'order_type' => $orderInfo['status'],
                'bill_id' => 0,
                'create_admin_id' => 0,
                'assign_admin_id' => 0,
                'from_ticket_id' => 0,
                'assign_time' => $time,
                'result' => 'issued', 
                'create_time' => $time,
                'update_time' => $time
            );
            importModel('Borrowing_Ticket')->create($ticketFieldData);
            // timeline流程更新
            $timelineFieldData = array(
                'order_id' => $orderInfo['id'],
                'user_id' => $orderInfo['user_id'],
                'type' => 'normal',
                'content' => '随分期' .$orderInfo['actual_money']. '元打款成功',
                'create_time' => $time
            );
            importModel('Borrowing_Timeline')->create($timelineFieldData);
            return TRUE;
        }
        return FALSE;
    }
}
