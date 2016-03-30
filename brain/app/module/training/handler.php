<?php
    $responseData = array(
        'message' => 'failure',
    );
    $requestType = postv_t('requestType','addTrainingImage');
    //file_put_contents('/vagrant/data.log', json_encode($_POST)."\r\n",FILE_APPEND);
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
                Ext_Misc::api_output($responseData);
            }else{
                Ext_Misc::api_output($responseData);
            }
            break;
        default:
            break;
    }