<?php
    $responseData = array(
        'message' => 'failure',
    );
    $requestType = postv_t('requestType','addFarmImage');
    switch ($requestType) {
        case 'addFarmImage':
            $fileHash = md5(uniqid(mt_rand(), true));
            $farmExtend = importExtend('Farm');
            //3个参数：文件hash，文件对象-><input type="file" name="bannerImage">,错误信息->$message
            if(!$farmExtend->saveFarmImage($fileHash,'farmImage',$message)){
                $apiData['message'] = $message;
                Ext_Misc::api_output($apiData);
            }
            $src = array('src'=>'http://'.C('img_host').'/farm/width_200/' . $fileHash . ".jpg");
            echo json_encode($src);
            break;
        default:
            break;
    }