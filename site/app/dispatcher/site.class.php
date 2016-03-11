<?php

class Dispatcher_Site extends Core_Dispatcher {

    function BeforeRun() {
        //基础配置
        $modules = explode('.', $this->_module);
        $firstModule = current($modules);
        if (!$firstModule) {
            $this->_module = 'index';
        }
    }

}
