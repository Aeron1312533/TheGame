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
        } else{
            Zend_Registry::set('role', 'guest');
        }

        $acl = new Application_Model_Acl();
        Zend_Registry::set('acl', $acl);

    }
    
    protected function _initNavigations() {
        $nav_conf_files = glob(APPLICATION_PATH . '/configs/navigation/' . '*.ini');
        
        foreach($nav_conf_files as $item) {       
            $config = new Zend_Config_Ini($item); 
            $navigation = new Zend_Navigation($config); 
            
            Zend_Registry::set(basename($item, ".ini"), $navigation);
        }
    }
    
    protected function _initTranslation() {
        // Define the path where the language files are
        $langPath = APPLICATION_PATH . "/languages/";
        
        // Set default location to english
        $language = 'en';
        
        //check if user has not set own preferred language
        if (Zend_Auth::getInstance()->hasIdentity()){
            $language = Zend_Auth::getInstance()->getIdentity()->language;
        }
        
        $locale = new Zend_Locale($language);
        
        $locale->getLanguage();
        // Create an instance of Zend's ini adapter
        $translate = new Zend_Translate('ini', $langPath . $locale->getLanguage() . '.ini', $locale->getLanguage());
        $translate->setLocale($locale);
 
        // Set this Translation as global translation for the view helper
        Zend_Registry::set('Zend_Locale', $locale);
        Zend_Registry::set('Zend_Translate', $translate);
    }

}

