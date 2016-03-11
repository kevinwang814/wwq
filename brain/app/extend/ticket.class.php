<?php
class Extend_Ticket{
    
    public function getList($orderId){
        $option = array(
            'condition' => array('order_id' => $orderId)
        );
        $res = importModel('Borrowing_Ticket')->getList($option);
        if (!$res) {
            return NULL;
        }
        return $this->formatList($res);
    }
    
    public function formatList($ticketList){
        if(!is_array($ticketList)){
            return NULL;
        }
        $orderStatusMap = C('order_status_map');
        foreach ($ticketList as &$ticket) {
            $ticket['create_time'] = date('Y-m-d H-i-s', $ticket['create_time']);
            if(isset($orderStatusMap[$ticket['result']])){
                $ticket['resultCh'] = $orderStatusMap[$ticket['result']];
            }
            if($ticket['create_admin_id'] > 0){
                $adminInfo = importModel('Admin')->getBy(array('id'=>$ticket['create_admin_id']));
                $ticket['operator'] = $adminInfo['name'];
            }else{
                $ticket['operator'] = 'Admin';
            }            
        }
        return $ticketList;
    }
    
}

