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
class Extend_Finance_Summary {
    
    /**
     * 获得到账金额
     * @return int
     */
    public function getArrivalAmount(){
        $sql = "SELECT sum(amount) as arrivalAmount FROM suifenqi.b_finance_record where type = 'deposit'";
        $data = importModel('Record_Finance')->query($sql)->find();
        if($data['arrivalAmount']){
            return $data['arrivalAmount'];
        }
        return 0;
    }
    
    /**
     * 获得逾期金额
     * @return int
     */
    public function getOverdueAmount(){
        $sql = "SELECT sum(repay_money - repaid_money) as overdueAmount FROM suifenqi.b_bill"
             . " where overdue_day > 0 and status <> 'closed'";
        $data = importModel('Bill')->query($sql)->find();
        if($data['overdueAmount']){
            return $data['overdueAmount'];
        }
        return 0;
    }

    /**
     * 获得挂账金额
     * @return int
     */
    public function getBillAmount(){
        $sql = "SELECT sum(balance) as billAmount FROM suifenqi.b_repay_record where balance > 0 and bill_id in"
             . " (SELECT id FROM suifenqi.b_bill where status = 'closed' and now() < overdue_date group by order_id)";
        $data = importModel('Bill')->query($sql)->find();
        if($data['billAmount']){
            return $data['billAmount'];
        }
        return 0;
    }
}