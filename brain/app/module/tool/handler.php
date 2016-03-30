<?php
    $responseData = array(
        'message' => 'failure',
    );
    $requestType = postv_t('requestType','addToolImage');
    switch ($requestType) {
        case 'addToolImage':
            $fileHash = md5(uniqid(mt_rand(), true));
            $toolExtend = importExtend('Tool');
            //3个参数：文件hash，文件对象-><input type="file" name="bannerImage">,错误信息->$message
            if(!$toolExtend->saveToolImage($fileHash,'toolImage',$message)){
                $apiData['message'] = $message;
                Ext_Misc::api_output($apiData);
            }
            $src = array('src'=>'http://'.C('img_host').'/tool/width_200/' . $fileHash . ".jpg");
            echo json_encode($src);
            break;
        default:
            break;
    }