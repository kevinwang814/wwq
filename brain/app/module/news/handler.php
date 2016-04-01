<?php
    $responseData = array(
        'message' => 'failure',
    );
    $requestType = postv_t('requestType','addNewsImage');
    file_put_contents('/vagrant/data.log', json_encode($_POST)."\r\n",FILE_APPEND);
    switch ($requestType) {
        //添加新闻图片
        case 'addNewsImage':
            $fileHash = md5(uniqid(mt_rand(), true));
            $newsExtend = importExtend('News');
            //3个参数：文件hash，文件对象-><input type="file" name="bannerImage">,错误信息->$message
            if(!$newsExtend->saveNewsImage($fileHash,'newsImage',$message)){
                $apiData['message'] = $message;
                Ext_Misc::api_output($apiData);
            }
            $src = array('src'=>'http://'.C('img_host').'/news/width_200/' . $fileHash . ".jpg");
            echo json_encode($src);
            break;
        //新增新闻
        case 'createNews':
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
            if (importModel('News')->create($fieldData)) {
                $ret = true;
            }
            if($ret){
                $responseData['message'] = "success";
                Ext_Misc::api_output($responseData);
            }else{
                Ext_Misc::api_output($responseData);
            }
            break;
        //删除新闻
        case 'deleteNews':
            $news_id = postv_t('newsId');
            $fieldData = array(
                'status' => 'disabled',
            );
            $time = time();
            $ret = false;
            $newsModel = importModel('News');
            if($news_id != ''){
                $cond = array(
                    'id'=>$news_id,
                );
                $fieldData['update_time'] = $time;
                if($newsModel->updateBy($cond, $fieldData)){
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
        //根据id获取新闻详情
        case 'detailNews':
            $id = postv_t('id');
            $newsInfo = importExtend('News')->getInfo($id);
            //file_put_contents('/vagrant/data.log', json_encode($newsInfo)."\r\n",FILE_APPEND);
            if($newsInfo){
                $responseData['message'] = "success";
                $responseData['newsInfo'] = $newsInfo;
                Ext_Misc::api_output($responseData);
            }else{
                Ext_Misc::api_output($responseData);
            }
            break;
        default:
            break;
    }