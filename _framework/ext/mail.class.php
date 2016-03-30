<?php
class Ext_Mail
{
    static public function sendMail($type, $revMailList, $subject, $body)
    {
        $allowType = array('plain', 'html');
        if(!in_array($type, $allowType))
        {
            return false;
        }

        $gc = new GearmanClient();
        $gc->addServer();
        
        $params = array(
            'type' => $type,
            'rev_mail_list' => $revMailList,
            'subject' => $subject,
            'body' => $body,
        );
        
        $gc->doBackground('sendMail', json_encode($params));
        if($gc->returnCode() != GEARMAN_SUCCESS)
        {
            return false;
        }
        return true;
    }
}
?>
