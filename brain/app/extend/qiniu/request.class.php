<?php
require Qiniu_PATH . '/autoload.php';
use Qiniu\Auth;
class Extend_Qiniu_Request{
    
    /**
     * 获取七牛上传授权
     * @param type $user_id
     * @return type
     */
    public function createUploadToken($user_id){
        $bucket = C('qiniu.space_video');
        $accessKey = C('qiniu.ak');
        $secretKey = C('qiniu.sk');
        $auth = new Auth($accessKey, $secretKey);
        
        $policy = array(
            'callbackUrl' => C('base_site_url') . 'gateway.cgi?mod=notify.qiniu.callback&v=1',
            'callbackBody' => '{"fname":"$(fname)","fkey":"$(key)","uid":' . $user_id . '}'
        );
        $upToken = $auth->uploadToken($bucket, null, 3600, $policy);
        header('Access-Control-Allow-Origin:*');
        return $upToken;
    }
    
    /**
     * 获取下载凭证
     * @param type $file_key
     * @param type $frame
     * @return type
     */
    public function getDownloadToken($file_key,$frame = 0){
        $accessKey = C('qiniu.ak');
        $secretKey = C('qiniu.sk');
        $auth = new Auth($accessKey, $secretKey);
        
        // 私有空间中的外链http://<domain>/<file_key>
        $baseUrl = C('qiniu.space_video_url').$file_key."?pm3u8/0";
        if($frame > 0){
            $baseUrl = C('qiniu.space_video_url').$file_key."?vframe/jpg/offset/" . $frame;
        }
        return $auth->privateDownloadUrl($baseUrl);
    }
}

