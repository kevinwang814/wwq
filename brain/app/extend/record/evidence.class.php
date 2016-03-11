<?php
/**
 * Description of recharge
 *
 * @author xiaojie
 */
class Extend_Record_Evidence{
    /**
     * 根据条件查询Record_Evidence列表
     * 
     * @param array $option 查询条件
     * @return array 返回Record_Evidence处理信息
     */
    public function getList($option){
        $res = importModel('Record_Evidence')->getList($option);
        if (!$res) {
            return NULL;
        }
        return $this->formatList($res);
    }
    
    /**
     * 格式化凭证信息
     * @param type $recordEvidenceList
     * @return type
     */
    public function formatList($recordEvidenceList){
        if(!is_array($recordEvidenceList)){
            return NULL;
        }
        foreach ($recordEvidenceList as &$recordEvidence){
            $recordEvidence['repay_time'] = date('Y-m-d H:i:s', $recordEvidence['repay_time']);
            if($recordEvidence['source'] == 'liandongyoushi'){
                $recordEvidence['source'] = '联动优势';
            }else if($recordEvidence['source'] == 'weixin'){
                $recordEvidence['source'] = '微信';
            }else if($recordEvidence['source'] == 'zhifubao'){
                $recordEvidence['source'] = '支付宝';
            }else if($recordEvidence['source'] == 'banktransfer'){
                $recordEvidence['source'] = '银行转账';
            }else if($recordEvidence['source'] == 'cash'){
                $recordEvidence['source'] = '现金';
            }
            if($recordEvidence['type'] == 'repayment'){
                $recordEvidence['type'] = '还款凭证';
            }else if($recordEvidence['type'] == 'overdue'){
                $recordEvidence['type'] = '罚息凭证';
            }else if($recordEvidence['type'] == 'payment'){
                $recordEvidence['type'] = '借款凭证';
            }
            if($recordEvidence['admin_id'] > 0){
                $adminInfo = importModel('Admin')->getBy(array('id'=>$recordEvidence['admin_id']));
                $recordEvidence['operator'] = $adminInfo['name'];
            }else{
                $recordEvidence['operator'] = '--';
            }
            if($recordEvidence['status'] == 'repay'){
                $recordEvidence['status'] = '待确认';
                $recordEvidence['action'] = "<a data-toggle='modal' href='javascript:void(0)' onclick='changeRepayStatus(". 
                                            $recordEvidence['id'].")'>确认收款</a>";
            }else if($recordEvidence['status'] == 'repaid'){
                $recordEvidence['status'] = '已确认';
                $recordEvidence['action'] = '<a>查看</a>';
            }
            if($recordEvidence['repaid_time'] > 0){
                $recordEvidence['repaid_time'] = date('Y-m-d H:i:s',$recordEvidence['repaid_time']);
            }
        }
        return $recordEvidenceList;
    }
}
