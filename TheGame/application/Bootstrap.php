<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
    
    /*protected function _initSession() {
        Zend_Session::start();
        Zend_Session::rememberMe(10); 
    }*/
    
    protected function _initGameLibrary() {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('Game_');
    }
    
    protected function _initLoginConfig() {
        $config = new Zend_Config_Ini(
            APPLICATION_PATH . '/configs/login/login.ini', APPLICATION_ENV
        );
        
        Zend_Registry::set('login', $config);
        return $config; 
    }
    
    protected function _initAcl() {         
       if (Zend_Auth::getInstance()->hasIdentity()){
            Zend_Registry::set ('role',
                     Zend_Auth::getInstance()->getStorage()
                                              ->read()
                                              ->role);
        }else{
            Zend_Registry::set('role', 'guest');
        }

        $acl = new Application_Model_Acl();
        Zend_Registry::set('acl', $acl);

    }

}

