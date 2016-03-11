<?php
    //状态初始化
    $apiData = array(
        'status' => 'failure',
    );
    //file_put_contents('/vagrant/data.log', json_encode($_POST)."\r\n",FILE_APPEND);
    if(isset($_POST['dealType']) && $_POST['dealType'] == 'deleteCollege'){
        $fieldData = array(
            'status' => 'deleted',
        );
        $time = time();
        $ret = false;
        $collegeModel = importModel('College');
        if($_POST['collegeId'] != ''){
            $cond = array(
                'id'=>$_POST['collegeId'],
            );
            $fieldData['update_time'] = $time;
            if($collegeModel->updateBy($cond, $fieldData)){
                $ret = true;
            }
        }
        if($ret){
            $apiData['status'] = "success";
            Ext_Misc::api_output($apiData);
        }else{
            Ext_Misc::api_output($apiData);   
        }
        
    }
    
    
    if(isset($_POST['dealType']) && $_POST['dealType'] == 'addCollege'){
        //file_put_contents('/vagrant/data.log', json_encode($_POST)."\r\n",FILE_APPEND);
        if($_POST['level'] == 0){
            //选择省份
            $option1 = array(
                'condition'=>array(
                    'level'=>0
                ),
            );
            $provList = importModel('Area')->getList($option1);
            if($provList){
                $apiData['status'] = "success";
                $apiData['provList'] = $provList;
                //选择市区
                $option2 = array(
                    'condition'=>array(
                        'level'=>1,
                        'parent_id'=>$provList[0]['id']
                    )
                );
                $cityList = importModel('Area')->getList($option2);
                if($cityList){
                    $apiData['cityList'] = $cityList;
                }
                Ext_Misc::api_output($apiData);
            }else{
                Ext_Misc::api_output($apiData);   
            }
        }else if($_POST['level'] == 1){
            //选择城市
            $option = array(
                'condition'=>array(
                    'level'=>1,
                    'parent_id'=>$_POST['provId'],
                ),
            );
            $cityList = importModel('Area')->getList($option);
            if($cityList){
                $apiData['status'] = "success";
                $apiData['cityList'] = $cityList;
                Ext_Misc::api_output($apiData);
            }else{
                Ext_Misc::api_output($apiData);
            }
        }

        
    }
    
    
    if(isset($_POST['dealType']) && $_POST['dealType'] == 'saveCreate'){
        //file_put_contents('/vagrant/data.log', json_encode($_POST)."\r\n",FILE_APPEND);
            //选择省份
        $collegeModel = importModel('College');
        $time = time();
        $fieldData = array(
            'area_id'=>$_POST['areaId'],
            'name'=>$_POST['name'],
            'status'=>'enabled',
            'update_time'=>$time,
            'create_time'=>$time,
        );
        $ret = false;
        if ($collegeModel->create($fieldData)) {
            $ret = true;
        }
        if($ret){
            $apiData['status'] = "success";
            Ext_Misc::api_output($apiData);
        }else{
            Ext_Misc::api_output($apiData);   
        }


        
    }
    
    
    
    
    if(isset($_POST['dealType']) && $_POST['dealType'] == 'detailCollege'){
        //$id = $_POST['collId'];
        $area_id = $_POST['areaId'];
        $parent_id = $_POST['parentId'];
        $option1 = array(
            'condition'=>array(
                'level'=>0
            ),
        );
        $provList = importModel('Area')->getList($option1);
        if($provList){
            $apiData['provList'] = $provList;
            $apiData['status'] = 'success';
            if($parent_id == ''){
                //$parent_id 不存在
                $apiData['provId'] = $area_id;
                //选出市辖区、市辖县(展示用)
                $option2 = array(
                    'condition'=>array(
                        'level'=>1,
                        'parent_id'=>$area_id
                    ),
                );
            }else{
                //$parent_id 存在
                $option2 = array(
                    'condition'=>array(
                        'level'=>1,
                        'parent_id'=>$parent_id
                    ),
                );
                $apiData['provId'] = $parent_id;
                $apiData['cityId'] = $area_id;
            }
            $cityList = importModel('Area')->getList($option2);
            if($cityList){
                $apiData['cityList'] = $cityList;
            }
            Ext_Misc::api_output($apiData);
        }else{
            Ext_Misc::api_output($apiData);   
        }
        
    }
    
    
    
    
    
    if(isset($_POST['dealType']) && $_POST['dealType'] == 'saveUpdate'){
        //file_put_contents('/vagrant/data.log', json_encode($_POST)."\r\n",FILE_APPEND);
            //选择省份
        $collegeModel = importModel('College');
        $time = time();
        $cond = array(
            'id'=>$_POST['collId']
        );
        $fieldData = array(
            'area_id'=>$_POST['areaId'],
            'name'=>$_POST['name'],
            'update_time'=>$time,
        );
        $ret = false;
        if ($collegeModel->updateBy($cond,$fieldData)) {
            $ret = true;
        }
        if($ret){
            $apiData['status'] = "success";
            Ext_Misc::api_output($apiData);
        }else{
            Ext_Misc::api_output($apiData);   
        }


        
    }