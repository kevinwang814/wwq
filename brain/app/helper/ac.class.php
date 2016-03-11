<?php

class Helper_AC{
    private $_module;
    private $_id;
    private $_role;
    private $_role_module;

    public function __construct($module){
        $this->_module = $module;
        $this->_id = sessionv('admin.id','0');
        $this->_role = sessionv('admin.role', 'linshi');
        $this->_role_module = $this->loadRoleModule();
    }
    
     public function loadRoleModule(){
        return array(
            '0' => array('admin.login','admin.index','admin.logout','admin.captcha')
        );
    }
    
    
    public function check(){
        var_dump($this->_id);
        if($this->_id != '0'){
            return TRUE;
        }else{
             //R(U("admin/login"));
            exit;
        }
//        if(!isset($this->_role_module[$this->_id])){
//            show_error('访问错误');
//        }
//        if(in_array($this->_module, $this->_role_module[$this->_id])){
//            return TRUE;
//        }
//        echo "123";die;
       
        
    }
}