<?php
    //用户地理位置信息 扩展类 edited by wangzb
    class Extend_User_Info_Geography{
        /*
         * @param type $option array  sql参数
         * @param type return $geographyList array 地理位置信息
         */
        public function getList($option){
            $sql = 'select buig.id,buig.country,buig.province,buig.city,buig.district,buig.address,buig.longitude,buig.latitude,buig.update_time,buib.name,bu.mobile_num,buig.user_id from b_user_info_geography as buig left join b_user_info_base as buib on buig.user_id = buib.user_id left join b_user as bu on bu.id = buib.user_id order by '.$option['orderby'].' limit '.$option['offset'].','.$option['limit'];
            $res = importModel('User_Info_Geography')->query($sql)->findAll();
            if(!$res){
                return null;
            }else {
                return $this->formatList($res);
            }
        }
        
        /*
         *@param type $geographyList array   //地理位置信息
         * @param type return $geographyList array //格式化后的地理位置信息
         */
        
        public function formatList($geographyList){
            foreach ($geographyList as &$geographyInfo) {
                $geographyInfo['update_time'] = date('Y-m-d H:i:s',$geographyInfo['update_time']);
            }
            return $geographyList;
        }
    }