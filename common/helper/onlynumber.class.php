<?php

class Helper_OnlyNumber{
  
    public static function getBindOrderId(){
        return self::createOrderId('bind_order_id_incr','b');
    }

    public static function getReBindOrderId(){
        return self::createOrderId('rebind_order_id_incr','rb');
    }
    
    public static function getRechargeOrderId(){
        return self::createOrderId('recharge_order_id_incr','r');
    }
    
    public static function getTransferOrderId(){
        return self::createOrderId('transfer_order_id_incr','t');
    }
    
    public static function getChangeTransactionPwdOrderId(){
        return self::createOrderId('change_order_id_incr','c');
    }
    
    public static function getWithdrawalsOrderId(){
        return self::createOrderId('withdrawals_order_id_incr','w');
    }

    private static function createOrderId($key,$type){
        
        $time = date('YmdHis');
        
        $ret = $type . $time . C('host_id');
        
        $ret .= sprintf('%08d', Helper_Incr::get($key, 10000));

        return $ret;
        
    }
    
    public static function getExchangeNumber($preiod_id){
        $key = 'exchange_number_incr_'.$preiod_id;
        $ret = 10000000;
        $ret = $ret + Helper_Incr::get($key, 10000);
        return $ret;        
    }
}