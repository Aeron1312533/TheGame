<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *
 * @author peter.pekarovic
 */
class Application_Model_dataMapper_dbTable_User extends Game_DataMapper_Database {
    private $storageClassName = 'Application_Model_dbTable_User';
    
    public function __construct($model) {
        parent::init($model, new $this->storageClassName);
    }

}
