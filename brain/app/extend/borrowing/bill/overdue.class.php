<?php
/**
 * Description of overdue
 *
 * @author xiaojie
 */
class Extend_Borrowing_Bill_Overdue {
    
    /**
     * 根据金额和天数计算预期的罚息
     * @param type $overdueAmount
     * @param type $overdueDay
     * @return type
     */
    private function overdueAmountCalc($overdueAmount,$overdueDay){
        if($overdueAmount == 0 || $overdueDay < 1){ 
            return 0;
        }
        return round($overdueAmount * (0.005 * $overdueDay),2);
    }
    
    /**
     * 对个人逾期的账单进行逾期计算
     * @param type $billInfo
     * @return type
     */
    private function updateOverdueBill($billInfo){
        if($billInfo['status'] == 'closed'){
            return;
        }
        $overdue_date = $billInfo['overdue_date'];
        $time = time();
        // 过期时间,应该为当天后的一天,这里计算为第二天的2点计算,即:24+14个小时
        if(floor(($time - strtotime($overdue_date)) / 3600) < 24){
            return;
        }
        $overdue_day = $billInfo['overdue_day'];
        $bill_money = $billInfo['principal'] + $billInfo['interest'];
        $repaid_bill_money = $billInfo['repaid_principal'] + $billInfo['repaid_interest'];
        $overdue_fine = $billInfo['overdue_fine'];
        $repay_money = $billInfo['repay_money'];
        // 应还金额
        $overdueAmount = round($bill_money - $repaid_bill_money,2);
        $overdueTotalDay = ceil(($time - strtotime($overdue_date)) / 3600 / 24 - 1);
        $overdueDay = $overdueTotalDay;
        if($overdue_day > 0){
            $overdueDay = $overdueTotalDay - $overdue_day;
        }
        // 当前罚息
        $current_overdue_fine = $this -> overdueAmountCalc($overdueAmount,$overdueDay);
        if($current_overdue_fine == 0){
            return;
        }
        $overdue_fine = $overdue_fine + $current_overdue_fine;
        $repay_money = $repay_money + $current_overdue_fine;
        
        // 更新账单信息
        $updateContent = array(
            'status' => 'overdue',
            'overdue_day' => $overdueTotalDay,
            'repay_money' => $repay_money,
            'overdue_fine' => $overdue_fine,
            'update_time' => $time,
        );
        if(importModel('Bill') -> updateBy(array('id' => $billInfo['id']),$updateContent)>0){
            // timeline更新
            importModel('Borrowing_Timeline')->create(array(
                'order_id' => $billInfo['order_id'],
                'user_id' => $billInfo['user_id'],
                'type' => 'warning',
                'content' => '您还款已逾期' . $overdueTotalDay . '天，逾期金额为' . $overdueAmount
                    . '元，违约金为' . $overdue_fine . '元，请及时还款',
                'create_time' => $time
            ));
            // push消息
            importHelper('Notification')->sendByUser($billInfo['user_id'],"您的随分期订单已逾期".$overdueTotalDay."天，请尽快还款");
        }
    }
    
    /**
     * 处理逾期的账单
     * @return boolean
     */
    public function handlerAllOverdueBill(){
        $sql = "SELECT * FROM suifenqi.b_bill where DATE_ADD(overdue_date,INTERVAL 1 DAY) <= now() "
             . " and is_valid = 1 and status <> 'closed'";
        $data = importModel('Bill')->query($sql)->findAll();
        if($data && !empty($data)){
            $overdue_bill_count = array();
            foreach($data as $billInfo){
                $this -> updateOverdueBill($billInfo);
                $overdue_bill_count[$billInfo['order_id']][] = $billInfo['id'];
            }
            // 修改order表信息
            $orderModel = importModel('Borrowing_Order');
            foreach ($overdue_bill_count as $key => $value){
                $order_id = $key;
                $count = count($value);
                $orderModel -> updateBy(array('id' => $order_id),array('overdue_bill_count' => $count));
            }
        }
        return TRUE;
    }
}