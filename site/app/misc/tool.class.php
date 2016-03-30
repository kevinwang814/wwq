<?php
    class Misc_Tool{
        static public function showError($errMsg){
            $view = Core_View::getInstance();
            $view->assign('errMsg',$errMsg);
            $view->display('recharge/error.tpl.php');
            exit;
        }
        
    }