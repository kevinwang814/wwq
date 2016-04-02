<?php
    $responseData = array(
        'message' => 'failure',
    );
    $requestType = postv_t('requestType','addTrainingImage');
    //file_put_contents('/vagrant/data.log', $requestType."\r\n",FILE_APPEND);
    switch ($requestType) {
        case 'addTrainingImage':
            $fileHash = md5(uniqid(mt_rand(), true));
            $trainingExtend = importExtend('Training');
            //3个参数：文件hash，文件对象-><input type="file" name="bannerImage">,错误信息->$message
            if(!$trainingExtend->saveTrainingImage($fileHash,'trainingImage',$message)){
                $apiData['message'] = $message;
                Ext_Misc::api_output($apiData);
            }
            $src = array('src'=>'http://'.C('img_host').'/training/width_200/' . $fileHash . ".jpg");
            echo json_encode($src);
            break;
        case 'createTraining':
            $title = postv_t('title');
            $description = postv_t('description');
            $content = postv_t('content');
            $imgStr = substr(postv_t('imgStr'), 0,-1);
            $imgArr = explode(',',$imgStr);
            $hashStr = '';
            foreach ($imgArr as $imgSrc) {
                $imgSrcArr = explode('/',$imgSrc);
                $hashStr .= substr($imgSrcArr[count($imgSrcArr)-1],0,32).',';
            }
            $hashStr = substr($hashStr,0,-1);
            $time = time();
            $fieldData = array(
                'title' => $title,
                'description' => $description,
                'content' => $content,
                'hash' => $hashStr,
                'create_time' => $time,
                'update_time' => $time,
                'status' => 'enabled',
            );
            $ret = false;
            if (importModel('Training')->create($fieldData)) {
                $ret = true;
            }
            if($ret){
                $responseData['message'] = "success";
                //file_put_contents('/vagrant/data.log', json_encode($responseData)."\r\n",FILE_APPEND);
                Ext_Misc::api_output($responseData);
                //json_encode($responseData);
            }else{
                Ext_Misc::api_output($responseData);
            }
            break;

        //删除新闻
        case 'deleteTraining':
            $training_id = postv_t('trainingId');
            $fieldData = array(
                'status' => 'disabled',
            );
            $time = time();
            $ret = false;
            $trainingModel = importModel('Training');
            if($training_id != ''){
                $cond = array(
                    'id'=>$training_id,
                );
                $fieldData['update_time'] = $time;
                if($trainingModel->updateBy($cond, $fieldData)){
                    $ret = true;
                }
            }
            if($ret){
                $responseData['status'] = "success";
                Ext_Misc::api_output($responseData);
            }else{
                Ext_Misc::api_output($responseData);   
            }
            break;
        //根据id获取培训详情
        case 'detailTraining':
            $id = postv_t('id');
            $trainingInfo = importExtend('Training')->getInfo($id);
            //file_put_contents('/vagrant/data.log', json_encode($newsInfo)."\r\n",FILE_APPEND);
            if($trainingInfo){
                $responseData['message'] = "success";
                $responseData['trainingInfo'] = $trainingInfo;
                Ext_Misc::api_output($responseData);
            }else{
                Ext_Misc::api_output($responseData);
            }
            break;
        case 'updateTraining':
            $title = postv_t('title');
            $description = postv_t('description');
            $content = postv_t('content');
            $imgStr = substr(postv_t('imgStr'), 0,-1);
            $imgArr = explode(',',$imgStr);
            $hashStr = '';
            foreach ($imgArr as $imgSrc) {
                $imgSrcArr = explode('/',$imgSrc);
                $hashStr .= substr($imgSrcArr[count($imgSrcArr)-1],0,32).',';
            }
            $hashStr = substr($hashStr,0,-1);
            $time = time();
            $fieldData = array(
                'title' => $title,
                'description' => $description,
                'content' => $content,
                'hash' => $hashStr,
                'update_time' => $time,
                'status' => 'enabled',
            );
            $ret = false;
            if (importModel('Training')->create($fieldData)) {
                $ret = true;
            }
            if($ret){
                $responseData['message'] = "success";
                Ext_Misc::api_output($responseData);
            }else{
                Ext_Misc::api_output($responseData);
            }
            break;
        default:
            break;
    }