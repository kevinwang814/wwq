<?php
    //学校信息扩展 edited by wangzb
    class Extend_Area{
        /*
         * @param type $option array  sql参数
         * @param type return $collegeList array 地理位置信息
         */
        public function getList($option){
            //$sql = 'select bc.name,ba. from b_college as  bc LEFT JOIN b_area as ba ON bc.area_id=ba.id where bc.status="'.$option['status'].'"order by '.$option['orderby'].' limit '.$option['offset'].','.$option['limit'];
            $sql = 'select bc.id as collId,bc.name as collName,bc.area_id as areaId,ba.name as areaName,ba.parent_id as parentId,ba.level as areaLevel from b_college as  bc LEFT JOIN b_area as ba ON bc.area_id=ba.id where bc.status="'.$option['status'].'" order by bc.id ASC limit '.$option['offset'].','.$option['limit'];
            //file_put_contents('/vagrant/data.log', $sql."\r\n",FILE_APPEND);
            $res = importModel('College')->query($sql)->findAll();
            if(!$res){
                return null;
            }else {
                return $this->formatList($res);
            }
        }
        
        /*
         *@param type $collegeList array   //
         * @param type return $collegeList array //
         */
        
        public function formatList($collegeList){
            foreach ($collegeList as &$collegeInfo) {
            }
            return $collegeList;
        }
        
    }