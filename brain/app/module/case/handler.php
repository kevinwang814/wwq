<?php
    $responseData = array(
        'message' => 'failure',
    );
    $requestType = postv_t('requestType','addCaseImage');
    switch ($requestType) {
        case 'addCaseImage':
            $fileHash = md5(uniqid(mt_rand(), true));
            $caseExtend = importExtend('Case');
            //3个参数：文件hash，文件对象-><input type="file" name="bannerImage">,错误信息->$message
            if(!$caseExtend->saveCaseImage($fileHash,'caseImage',$message)){
                $apiData['message'] = $message;
                Ext_Misc::api_output($apiData);
            }
            $src = array('src'=>'http://'.C('img_host').'/case/width_200/' . $fileHash . ".jpg");
            echo json_encode($src);
            break;
        default:
            break;
    }