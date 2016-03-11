<?php
include COMMON_PATH . '/util/common.php';

class Extend_Soopay_Request{
    
    function merchantWithdrawals($requestData){
        // 申明参数
        $map = new HashMap();
        $map->put("service","mer_withdrawals");  
        $map->put("sign_type","RSA");  
        $map->put("charset","UTF-8");
        $map->put("res_format","HTML");  
        $map->put("mer_id",C('soopay_mer_id'));  
        $map->put("version","1.0");
        $map->put("notify_url",C('base_site_url') . "notify/soopay/async/withdrawals.html");
        $map->put("order_id",$requestData['order_id']);  
        $map->put("mer_date",date('Ymd'));  
        $map->put("withdraw_mer_id",C('soopay_mer_id'));  
        $map->put("account_id","");  
        $map->put("amount",$requestData['amount']);
        $handlerData = NULL;
        // 获取请求数据
        $reqDataGet = importHelper('mertoplat')->makeRequestDataByGet($map);
        if($reqDataGet){
            $time = time();
            // 请求前保存数据
            $fieldData = array(
                'service' => 'mer_withdrawals',
                'sign_type' => 'RSA',
                'charset' => $map -> get('charset'),
                'res_format' => $map -> get('res_format'),
                'mer_id' => $map -> get('mer_id'),
                'mer_date' => $map -> get('mer_date'),
                'version' => $map -> get('version'),      
                'plat_order_id' => $map -> get('order_id'),
                'withdraw_user_id' => C('soopay_mer_id'),
                'amount' => round($requestData['amount']/100,2),
                'create_time' => $time,
                'update_time' => $time,
            );
            importModel('Record_Withdrawals')->create($fieldData);
            // 请求Url
            $getUrl = $reqDataGet->getUrl();
            $requestExt = new Ext_Http();
            $resultInfo = $requestExt -> sendRequest($getUrl);
            if($resultInfo){
                // 处理响应数据
                $handlerData = importHelper('plattomer')->getResDataByHtml($resultInfo); 
            }
        }
        return $handlerData;
    }    
}

