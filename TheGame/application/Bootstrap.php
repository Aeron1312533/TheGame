<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initEshopConfig() {
        $config = new Zend_Config_Ini(
            APPLICATION_PATH . '/modules/eshop/configs/eshop.ini', APPLICATION_ENV
        );
        
        Zend_Registry::set('eshop', $config);
        return $config; 
    }

}

