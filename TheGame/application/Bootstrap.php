<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
    
    protected function _initSession() {
        Zend_Session::start();
    }
    
    protected function _initGameLibrary() {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('Game_');
    }
    
    protected function _initLoginConfig() {
        $config = new Zend_Config_Ini(
            APPLICATION_PATH . '/configs/login.ini', APPLICATION_ENV
        );
        
        Zend_Registry::set('login', $config);
        return $config; 
    }

}

