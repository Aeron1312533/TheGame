<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of register
 *
 * @author Azgot
 */
class Application_Form_User_Register extends Game_Form {
    
    public function init() {
        $configFilePath = APPLICATION_PATH . "/forms/user/configs/register.ini";
        $config = new Zend_Config_Ini($configFilePath);
        
        $this->setConfig($config);
       
    }
    
    
}
