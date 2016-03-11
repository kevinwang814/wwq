<?php
    class Extend_Goods_Buy{
        
        /*获取本期抢购信息列表
         *@param array $option
         */
        public function getList($option){
            $sql = 'select * from '
                    . '(select bgb.id,bgb.number,bgb.preiod_id,bgb.create_time,bgb.user_id,buib.identity_card,buib.name,bu.mobile_num from b_goods_buy as bgb '
                    . 'left join '
                    . 'b_user_info_base as buib on bgb.user_id = buib.user_id '
                    . 'left join '
                    . 'b_user as bu on bu.id = buib.user_id where bgb.preiod_id = '.$option['condition']['id'].')'
                    . ' as A '
                    . 'left join '
                    . '(select user_id as user_id_cover,count(user_id) as buy_times from b_goods_buy where preiod_id = '.$option['condition']['id'].' '
                    . 'group by '
                    . 'user_id) '
                    . 'as B '
                    . 'on '
                    . 'A.user_id = B.user_id_cover '
                    . 'order by '.$option['orderby'].' limit '.$option['offset'].','.$option['limit'];
            $res =importModel('Goods_Buy')->query($sql)->findAll();
            if (!$res) {
                return NULL;
            }
            return $this->formatList($res);
        }
        
        /*
         * 格式化信息
         * @param array $buyList
         */
        
        public function formatList($buyList){
            foreach ($buyList as &$buyInfo) {
                $buyInfo['create_time'] = date('Y-m-d H:i:s',$buyInfo['create_time']); 
            }
            return $buyList;
        }
    }