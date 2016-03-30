<?php

/**
 * 消息通知类, PUSH消息到移动端, 或通过短信发送消息到手机
 */

class Helper_Notification {

    private $_redisConn;
    private $_redisKey;

    public function __construct() {
        try {
            $config = C('redis');
            $this->_redisConn = Ext_Cache_Redis::getInstance($config['redis_host'], $config['redis_port'], $config['redis_auth']);
        } catch (RedisException $e) {
            LOGE("连接redis时发生错误：" . var_export($e, true));
        }
        $this->_redisKey = 'notification_queue';
    }


    /**
     * 根据用户id发送通知
     * 
     * @param string|array $user_id 单个用户id, 或多个用户id列表
     * @param string $message 要发送的通知内容
     * @param string $channel 通知发送渠道, push(推送) sms(短信) all(前两者同时发送)
     * @param string $extra 额外数据, 例如: 商品id, 让客户端可以定向到该商品页面, 仅在push时使用, 取决于客户端需求
     * @return boolean
     */
    public function sendByUser($user_id, $message, $channel = 'push', $extra = '') {
        if (empty($user_id) || empty($message)) {
            return FALSE;
        }

        if (!is_array($user_id)) {
            $user_id = array($user_id);
        }
        $user_id_list = $user_id;
        if(count($user_id_list) > 1000){
            return FALSE;
        }
        
        $push_reg_id_list = array();
        $mobile_num_list = array();
        foreach ($user_id_list as $user_id) {
            $user = importModel('User')->getBy(array('id' => $user_id));
            if(!$user){
                continue;
            }
            if (in_array($channel, array('push', 'all')) && $user['push_reg_id'] != '') {
                $push_reg_id_list[] = $user['push_reg_id'];
            }
            if (in_array($channel, array('sms', 'all')) && $user['mobile_num'] != '') {
                $mobile_num_list[] = $user['mobile_num'];
            }
        }
        
        $param = array(
            'push_reg_id_list' => implode(',', $push_reg_id_list),
            'mobile_num_list' => implode(',', $mobile_num_list),
            'message' => $message,
            'extra' => $extra,
        );

        try {
            $this->_redisConn->rPush($this->_redisKey, json_encode($param));
        } catch (RedisException $e) {
            LOGE("向redis推送队列写入数据时发生错误：" . var_export($e, true));
            return FALSE;
        }
        
        return TRUE;
    }
    
    public function sendGlobal($message, $extra = '') {
        if (empty($message)) {
            return FALSE;
        }
        
        $param = array(
            'message' => $message,
            'extra' => $extra,
            'global_push' => 1,
        );

        try {
            $this->_redisConn->rPush($this->_redisKey, json_encode($param));
        } catch (RedisException $e) {
            LOGE("向redis推送队列写入数据时发生错误：" . var_export($e, true));
            return FALSE;
        }

        return TRUE;
    }

}