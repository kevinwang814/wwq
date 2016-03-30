<?php

class Dispatcher_Site extends Core_Dispatcher {
    function BeforeRun() {
        //基础配置
        $modules = explode('.', $this->_module);
        $firstModule = current($modules);
        if (!$firstModule) {
            $this->_module = 'index';
        }
        //如果sessionv('admin')值存在着允许访问，改控制器、方法...
        if(sessionv('admin')){
            //表示函数结束执行，进入指定页面
            return true;
        }
        //如果session不存在且$this->_module == 'admin.login'
        if($this->_module == 'admin.login'){
            //函数结束执行，进入admin.login
            return true;
        }else{
            //如果session不存在，且$this->_module != admin.login
            R(U('admin/login'));
        }
    }
}