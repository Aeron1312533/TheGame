<?php

class Login_Form_Login extends Game_Form {

    public function init() {
        $configFilePath = APPLICATION_PATH . "/modules/login/forms/login.ini";
        $config = new Zend_Config_Ini($configFilePath);
        
        $this->setConfig($config);
    }

}

