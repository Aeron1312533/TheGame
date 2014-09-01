<?php

class Application_Form_User_Login extends Game_Form {

    public function init() {
        $configFilePath = APPLICATION_PATH . "/forms/user/configs/login.ini";
        $config = new Zend_Config_Ini($configFilePath);
        
        $this->setConfig($config);
    }

}

