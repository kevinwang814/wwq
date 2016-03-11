<?php
    class Extend_Goods{
        /*
         * 根据条件查询商品表
         * 
         * @param array $option   查询条件
         */
        public function getList($option){
            $res = importModel('Goods')->getList($option);
            if (!$res) {
                return NULL;
            }
            return $this->formatList($res);
        }
        
        public function formatList($goodsList){
            foreach ($goodsList as &$goods) {
                $goods['update_time'] = date('Y-m-d H:i:s',$goods['update_time']);
                
                //发布状态
                if($goods['publish_status'] == "not.participate"){
                    $goods['publish_status'] = '未参与';
                }else if($goods['publish_status'] == "being.revealed"){
                    $goods['publish_status'] = '正在揭晓';
                }else if($goods['publish_status'] == "past.participate"){
                    $goods['publish_status'] = '以往参加';
                }else if($goods['publish_status'] == "coming.participate"){
                    $goods['publish_status'] = '即将参加';
                }
                
                //开启状态
                if($goods['status'] == 'disabled'){
                    $goods['status'] = '禁用';
                }else if($goods['status'] == 'enabled'){
                    $goods['status'] = '启用';
                }
                 
            }
            return $goodsList;
        }
        
        public function getInfo($option){
            $res = importModel('Goods')->getBy($option);
            //file_put_contents('/vagrant/data.log', json_encode($res)."\r\n",FILE_APPEND);
            if (!$res) {
                return NULL;
            }
            return $this->formatInfo($res);
        }
        
        public function formatInfo($goodsInfo){                
                //开启状态
                //$goodsInfo['status'] = $goodsInfo['status']?"开启":"禁用";
                $goodsInfo['cover_img'] = "http://".C('img_host')."/image/goods/width_200/".$goodsInfo['cover_img'].".jpg";
                $goodsInfo['describe_img'] = "http://".C('img_host')."/image/goods/width_200/".$goodsInfo['describe_img'].".jpg";
                $goodsInfoCarouselArr = explode(',', $goodsInfo['carousel_img']);
                $goodsInfo['carousel_img'] = array();
                foreach($goodsInfoCarouselArr as $goodsInfoCarousel){
                    array_push($goodsInfo['carousel_img'],"http://".C('img_host')."/image/goods/width_200/".$goodsInfoCarousel.".jpg");
                }
                return $goodsInfo;
        }
        
        
        
        
        
    }
