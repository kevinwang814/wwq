<?php
class Helper_Sms
{   
    static private $delay_list = array();
    
    /**
     * 发送短信
     * 
     * @param string    收信人手机号码
     * @param string    短信内容
     * @param string    是否延迟发送，如果为 TRUE，则将会等到执行析构函数的时候再尝试发送。这在要求快速完成发送短信处理的场合很有用，但缺点是无法获知短信是否发送成功
     * @param boolean   发送成功返回 TRUE，发送失败返回 FALSE 
     */
    public function send($mobile, $text, $delay = FALSE, &$err='') {
        if ($delay == TRUE) {
            $this->cacheDelay($mobile, $text);
            return TRUE;
        }
        
        /// 接口需要提供短信签名，即在短信末尾使用【】标注短信发件人
        $text .= "【随分期】";
        
        $params = array(
            'mobile' => $mobile,
            'message' => $text
        );
        
        LOGD("准备向“{$mobile}”发送短信，内容是：{$text}");
        
        
        $result = Ext_Http::sendRequest(C('sms_luosimao_gateway'), $params, 'POST', 30, 'api', C('sms_luosimao_apikey'));

        $json = array('error' => -1, 'message' => '无法将 API 返回的结果作为 JSON 进行解析');

        $json = json_encode($json);
        
        if ($result === FALSE) {
            LOGE("短信发送失败，收信人“${mobile}”，内容：{$text}");
        }
        else {
            $json = json_decode($result);
        }
        
        $err = $json->msg;
        
        if ($json->error == 0) {
            LOGI("短信发送成功，收信人是 ${mobile}，内容：{$text}");
            return TRUE;
        }
        else {
            LOGW("短信发送失败，收信人是 {$mobile}，原始返回结果：" . var_export($result, TRUE));
            return FALSE;
        }
        
        return FALSE;
    }
    
    
    
    /**
     * 缓存短信内容，直到析构函数的时候才发送
     */
    private function cacheDelay($mobile, $text) {
        LOGD("缓存延迟发送短信，收件人“{$mobile}”，短信内容：{$text}");
        self::$delay_list[] = array(
            'mobile' => $mobile,
            'text' => $text
        );
    }
    
    
    public function __destruct() {
        if (count(self::$delay_list) > 0) {
            LOGD("准备发送需要延迟发送的短信");
        }
        
        foreach (self::$delay_list as $v) {
            LOGD("发送被延迟发送的短信，收件人“{$v['mobile']}”，短信内容：{$v['text']}");
            $this->send($v['mobile'], $v['text'], FALSE);
        }
    }
    
    
}
?>
