<?php
class Extend_Goods_Preiod{
    /*
     * 根据条件查询商品表
     * 
     * @param array $option   查询条件
     */
    public function getList($option){
        $sql = "SELECT bgp.id,bgp.user_id,bgp.participant_count,bgp.lucky_num,bgp.status,bgp.publish_time,bg.name FROM b_goods_preiod as bgp left join b_goods as bg on bgp.goods_id = bg.id order by bgp.id DESC limit {$option['offset']},{$option['limit']}";
        $res = importModel('Goods_Preiod')->query($sql)->findAll();
        if (!$res) {
            return NULL;
        }
        return $this->formatList($res);
    }

    public function formatList($preiodList){
        foreach ($preiodList as &$preiod) {
            $preiod['publish_time'] = date('Y-m-d H:i:s',$preiod['publish_time']);
            //file_put_contents('/vagrant/data.log', json_encode($preiod['bgp.id'])."\r\n",FILE_APPEND);
            //开奖状态
            if($preiod['status'] == "init"){
                $preiod['status'] = '未开奖';
            }else if($preiod['status'] == "coming"){
                $preiod['status'] = '即将开奖';
            }else if($preiod['status'] == "ending"){
                $preiod['status'] = '已开奖';
            }else if($preiod['status'] == "confirming"){
                $preiod['status'] = '审核中';
            }


        }
        return $preiodList;
    }

    public function getInfo($option){
        //file_put_contents('/vagrant/data.log', json_encode($option)."\r\n",FILE_APPEND);
        $sql = 'select bgp.id,bgp.publish_time,bgp.share_url,bg.id as goods_id,bg.name,bgp.status from b_goods_preiod as bgp left join b_goods as bg on bg.id = bgp.goods_id where bgp.id = '.$option['condition']['id'];
        $res = importModel('Goods_Preiod')->query($sql)->find();
        
        //file_put_contents('/vagrant/data.log', json_encode($res)."\r\n",FILE_APPEND);
        if (!$res) {
            return NULL;
        }
        return $this->formatInfo($res);
    }

    public function formatInfo($preiodInfo){                
        $preiodInfo['publish_time'] = date('Y-m-d H:i:s',$preiodInfo['publish_time']);
        if($preiodInfo['status'] == 'ending'){
            $preiodInfo['status'] = "已开奖";
        }else if($preiodInfo['status'] == "confirming"){
            $preiodInfo['status'] = "审核中";
        }else if($preiodInfo['status'] == "coming"){
            $preiodInfo['status'] = "即将开奖";
        }else if($preiodInfo['status'] == "init"){
            $preiodInfo['status'] = "未开奖";
        }
        return $preiodInfo;
    }
    
    public function getLuckInfo($option){
        $sql = 'select bgp.id,buib.user_id,bu.mobile_num,buib.name,buib.identity_card,buib.gender,buie.college,bt.buy_times '
                . 'from (select id,user_id from b_goods_preiod where id='.$option['condition']['id'].') as bgp '
                . 'left join b_user as bu on bgp.user_id = bu.id '
                . 'left join b_user_info_base as buib on bu.id = buib.user_id '
                . 'left join b_user_info_edu as buie on buie.user_id = bu.id '
                . 'left join (select user_id,count(user_id) as buy_times from b_goods_buy where preiod_id ='.$option['condition']['id'].' group by user_id) as bt on bu.id = bt.user_id';
        $res = importModel('Goods_Preiod')->query($sql)->find();
        return $res;
    }
    
    public function getLuckAddress($option){
        $sql = 'select bgp.id as preiod_id,buis.user_id,buis.consignee,buis.track_num,buis.mobile_num,buis.area_address,buis.address from (select id,user_id from b_goods_preiod where id='.$option['condition']['id'].') as bgp left join b_user_info_shipaddress as buis on bgp.user_id = buis.user_id';
        $res = importModel('Goods_Preiod')->query($sql)->find();
        if (!$res) {
            return NULL;
        }
        return $this->formatLuckAddress($res);
    }
    
    public function formatLuckAddress($luckAddress){
        $luckAddress['address'] = $luckAddress['area_address'].' '.$luckAddress['address'];
        return $luckAddress;
    }
    /**
     * 确认抽奖号码
     */
    public function confirmLuckyNumber($luckyNum){
        $goodsPreiodModel = importModel('Goods_Preiod');             
        $goodsPreiodInfo = $goodsPreiodModel->getBy(array('status'=>'confirming'));
        if($goodsPreiodInfo){
            $user_id = $goodsPreiodInfo['user_id'];
            $updateInfo = array(
                'status' => "ending",
                'update_time' => time(),
            );
            $goodsBuyInfo = NULL;
            if($luckyNum){
                $goodsBuyInfo = importModel('Goods_Buy')->getBy(array(
                    'number' => $luckyNum,'preiod_id' => $goodsPreiodInfo['id']));
            }
            if($goodsBuyInfo){
                $updateInfo['lucky_num'] = $luckyNum;
                $user_id = $updateInfo['user_id'] = $goodsBuyInfo['user_id'];
            }
            // 获得本期需要确认的信息
            if(importModel('Goods_Preiod')->updateBy(array('id'=>$goodsPreiodInfo['id'],'status' => 'confirming')
                    ,$updateInfo)> 0){
                importHelper('Notification')->sendByUser($user_id,"恭喜您获得（" .$goodsPreiodInfo['id']. "期）抢购商品，请您及时在‘我的－抢购’纪录中填写收货地址。");
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * 产生抽奖号码
     * @return boolean
     */
    public function createLuckyNumber(){
        // 获得本期信息
        $data = importModel('Goods_Preiod')->getBy(array('status'=>'coming'));
        $time = time();
        if($data['id'] && $time > $data['publish_time']){
            // 获得总号码个数
            $numberCount = $this->getNumberCountByPreiodId($data['id']);
            $luckyNumber = 10000000;
            $user_id = 0;
            if($numberCount > 0){
                // 获取最后30个人的时间总和
                $timeTotal = $this->getTimeTotalByPreiodId($data['id']);
                // 求余
                $remainder = $timeTotal%$numberCount;
                // 最后号码
                $luckyNumber = 10000001 + $remainder;
            }
            // 获得中奖用户
            $goodsBuyInfo = importModel('Goods_Buy') -> getBy(array('number' => $luckyNumber,'preiod_id' => $data['id']));
            if($goodsBuyInfo){
                $user_id = $goodsBuyInfo['user_id'];
            }
            if(importModel('Goods_Preiod')->updateBy(array('id' => $data['id'],'status' => 'coming'),
                    array('lucky_num' => $luckyNumber,'user_id' => $user_id
                            ,'status' => 'confirming','update_time' => time())) > 0){
                // 修改商品状态
                importModel('Goods') -> updateBy(array('id' => $data['goods_id']),array(
                    'publish_status' => 'past.participate','update_time' => time()));

                // 开启下一个商品期数
                $this -> openNextGoodsPreiod();
                return TRUE;
            }
        }
        return FALSE;
    }
    
    /**
     * 获得本期的参与兑奖个数
     * @param type $preiodId
     * @return int
     */
    private function getNumberCountByPreiodId($preiodId){
        $sql = "SELECT count(id) as numberCount FROM suifenqi.b_goods_buy where preiod_id = {$preiodId}";
        $data = importModel('Goods_Preiod')->query($sql)->find();
        if($data['numberCount']){
            return $data['numberCount'];
        }
        return 0;
    }

    /**
     * 获得本期最后30个人的时间总和
     * @param type $preiodId
     * @return int
     */
    private function getTimeTotalByPreiodId($preiodId){
        $sql = "select sum(create_time) as timeTotal from "
             . " (SELECT create_time FROM suifenqi.b_goods_buy "
             . " where preiod_id = {$preiodId} order by id desc limit 30) as A";
        $data = importModel('Goods_Preiod')->query($sql)->find();
        if($data['timeTotal']){
            return $data['timeTotal'];
        }
        return 0;
    }
    
    /**
     * 开启下一个商品抢购活动
     * @return int
     */
    private function openNextGoodsPreiod(){
        $sql = "select id,goods_id from suifenqi.b_goods_preiod where status = 'init' order by id limit 1";
        $data = importModel('Goods_Preiod')->query($sql)->find();
        if($data['id']){
            // 修改期数状态
            importModel('Goods_Preiod') -> updateBy(array('id' => $data['id']),array(
                'status' => 'coming','update_time' => time()));
            // 修改商品状态
            importModel('Goods') -> updateBy(array('id' => $data['goods_id']),array(
                'publish_status' => 'being.revealed','update_time' => time()));
        }
        return FALSE;
    }
}