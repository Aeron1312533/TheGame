<?php

class Application_Form_User_Languages extends Game_Form {

    public function init() {
        $configFilePath = APPLICATION_PATH . "/forms/user/configs/languages.ini";
        $config = new Zend_Config_Ini($configFilePath);
        
        $this->setConfig($config);
    }

}
