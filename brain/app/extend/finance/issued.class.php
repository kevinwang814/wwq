<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of issued
 *
 * @author xiaojie
 */
class Extend_Finance_Issued {
    
    /**
     * 更新账单的金额
     * @param type $billInfo
     * @param type $repaidAmount
     * @param type $recordFinanceId
     * @return type
     */
    function updateBillInfo($billInfo,$repaidAmount,$recordFinanceId){
        $time = time();
        $repay_money = $billInfo['repay_money'];
        $repaid_money = $billInfo['repaid_money'];
        $principal = $billInfo['principal'];
        $repaid_principal = $billInfo['repaid_principal'];
        $interest = $billInfo['interest'];
        $repaid_interest = $billInfo['repaid_interest'];
        $overdue_fine = $billInfo['overdue_fine'];
        $repaid_overdue_fine = $billInfo['repaid_overdue_fine'];
        $currentRepaidInterest = 0;
        $currentRepaidPrincipal = 0;
        $currentRepaidOverdue = 0;
        $balance = $repaidAmount;
        $resultStatus = 'closed';
        $user_id = $billInfo['user_id'];
        $order_id = $billInfo['order_id'];
        if($billInfo['status'] == 'closed'){
            return array(
                'balance' => $balance,
                'bill_status' => $resultStatus,
            );
        }
        if($billInfo['status'] == 'settled' || $billInfo['status'] == 'unsettled' || $billInfo['status'] == 'repaying'){
            if($repaidAmount < $repay_money){
                if($repaidAmount < $interest){
                    $repaid_interest = $currentRepaidInterest = $repaidAmount;
                }else{
                    $repaid_interest = $currentRepaidInterest = $interest;
                    $repaid_principal = $currentRepaidPrincipal = $repaidAmount - $currentRepaidInterest; 
                }
                $resultStatus = 'unfinished';
                $balance = 0;
                $repaid_money = $repaidAmount;
            }else{
                $balance =round($repaidAmount - $repay_money,2);
                $repaid_principal = $currentRepaidPrincipal = $repay_money - $interest;
                $repaid_interest = $currentRepaidInterest = $interest;
                $repaid_money = $repay_money;
            }
        }
        if($billInfo['status'] == 'unfinished'){
            $temp_repaid_money = round($repaid_money + $repaidAmount,2);
            if($temp_repaid_money < $repay_money){
                if($temp_repaid_money < $interest){
                    $repaid_interest = $repaidAmount + $repaid_interest;
                    $currentRepaidInterest = $repaidAmount;
                }else{
                    $currentRepaidInterest = $interest - $repaid_money;
                    $currentRepaidPrincipal = $repaidAmount - $currentRepaidInterest;
                    $repaid_interest = $interest;
                    $repaid_principal = $repaid_money + $repaidAmount - $interest;
                }
                $resultStatus = 'unfinished';
                $balance = 0;
                $repaid_money = $repaid_money + $repaidAmount;
            }else{
                $balance = round($repaid_money + $repaidAmount - $repay_money,2);
                $repaid_interest = $interest;
                $repaid_principal = $repay_money - $interest;
                if($principal > 0){//本金不够
                    $currentRepaidPrincipal = $repaidAmount;
                }else{// 利息不够
                    $currentRepaidInterest = $interest - $repaid_interest;
                    $currentRepaidPrincipal = $repaidAmount - $currentRepaidInterest;
                }
                $repaid_money = $repay_money;
            }
        }
        if($billInfo['status'] == 'overdue'){
            $temp_repaid_money = round($repaid_money + $repaidAmount,2);
            if($temp_repaid_money < $repay_money){
                if($temp_repaid_money < $overdue_fine){// 不够罚息
                    $repaid_overdue_fine = $repaidAmount + $repaid_overdue_fine;
                    $currentRepaidOverdue = $repaidAmount;
                }else{
                    if($temp_repaid_money < ($interest + $overdue_fine)){
                        $currentRepaidOverdue = $overdue_fine - $repaid_overdue_fine;
                        $repaid_overdue_fine = $overdue_fine;
                        $repaid_interest = $repaid_money + $repaidAmount - $overdue_fine;
                        $currentRepaidInterest = $repaid_interest;
                    }else{
                        $currentRepaidOverdue = $overdue_fine - $repaid_overdue_fine;
                        $currentRepaidInterest = $interest - $repaid_interest;
                        $currentRepaidPrincipal = $repaidAmount - $currentRepaidInterest - $currentRepaidOverdue;                                            
                        $repaid_overdue_fine = $overdue_fine;
                        $repaid_interest = $interest;
                        $repaid_principal = $repaid_money + $repaidAmount - $overdue_fine - $interest;
                    }
                }
                $balance = 0;
                $resultStatus = 'overdue';
                $repaid_money = $repaid_money + $repaidAmount;
            }else{
                $balance = round($repaid_money + $repaidAmount - $repay_money,2);
                $repaid_interest = $interest;
                $repaid_overdue_fine = $overdue_fine;
                $repaid_principal = $repay_money - $interest - $overdue_fine;
                if($principal > 0){// 本金不够
                    $currentRepaidPrincipal = $repay_money - $repaid_money;
                }else{// 利息不够
                    if($interest > 0){
                        $currentRepaidPrincipal = $principal;
                        $currentRepaidInterest = $repaidAmount - $currentRepaidPrincipal;
                    }else{
                        //罚息不够
                        $currentRepaidInterest = $interest;
                        $currentRepaidPrincipal = $principal;
                        $currentRepaidOverdue = $repaidAmount - $interest - $principal;
                    }
                }
                $repaid_money = $repay_money;
            }            
        }
        // 更新账单结果
        importModel('Bill') -> updateBy(array('id' => $billInfo['id']),array(
            'repaid_money' => $repaid_money,
            'repaid_principal' => $repaid_principal,
            'repaid_interest' => $repaid_interest,
            'repaid_overdue_fine' => $repaid_overdue_fine,
            'status' => $resultStatus,
            'is_repaying' => 0,
            'update_time' => $time,
        ));        
        // 创建还款信息
        importModel('Record_Repay') -> create(array(
            'user_id' => $user_id,
            'bill_id' => $billInfo['id'],
            'order_id' => $order_id,
            'finance_record_id' => $recordFinanceId,
            'type' => 'deposit',
            'principal' => $currentRepaidPrincipal,
            'interest' => $currentRepaidInterest < 0 ? 0 : $currentRepaidInterest,
            'overdue_fine' => $currentRepaidOverdue,
            'balance' => $balance,
            'create_time' => $time,
        ));
        $returnData = array(
            'balance' => $balance,
            'bill_status' => $resultStatus,
        );
        return $returnData;
    }
    
    /**
     * 订单还款成功后,更新用户余额和随金币
     * @param type $orderInfo
     * @param type $balance
     */
    function updateSuccessOrderInfo($orderInfo,$balance){
        
        $time = time();
        //还款完成,更新状态和所得随金币
        $borrowingCalcInfo = importModel('Borrowing_Calc')->getBy(array(
            'period_num' => $orderInfo['period_num'],
            'apply_money' => $orderInfo['audit_money'],
            'period_type' => $orderInfo['period_type'])
        );
        $userAccountModel = importModel('User_Account');
        $userAccountInfo = $userAccountModel -> getBy(array('user_id' => $orderInfo['user_id']));
        $originBalance = $userAccountInfo['balance'];
        if($balance > 0){
            // 更新到用户余额
            $originBalance = $originBalance + $balance;
        }
        $userAccountModel -> updateBy(array('user_id' => $orderInfo['user_id']),array(
            'balance' => $originBalance,
            'total_coin' => $userAccountInfo['total_coin'] + $borrowingCalcInfo['gold_coin'],
        ));
        importModel('Borrowing_Order') -> updateBy(array('id' => $orderInfo['id'],'status' => 'issued'),
            array(
                'gain_coin' => $borrowingCalcInfo['gold_coin'],
                'status' => 'finished',
                'finish_time' => $time,
                'update_time' => $time,
            ));
        // 保存随金币流水信息
        importModel('Record_Coin')->create(array(
            'coin' => $borrowingCalcInfo['gold_coin'],
            'user_id' => $orderInfo['user_id'],
            'type' => 'deposit',
            'source' => '还款成功',
            'description' => date('Y-m-d H:i:s',$time).'还款成功,获得:'.$borrowingCalcInfo['gold_coin'].'个随金币',
            'create_time' => $time,
        ));
    }
}