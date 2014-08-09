<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
    
    protected function _initLoginConfig() {
        $config = new Zend_Config_Ini(
            APPLICATION_PATH . '/modules/Login/configs/login.ini', APPLICATION_ENV
        );
        
        Zend_Registry::set('login', $config);
        return $config; 
    }

}

