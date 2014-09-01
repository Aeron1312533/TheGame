<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author peter.pekarovic
 */
interface Game_Model_Interface {   
    public function getDataMapper();
    public function setDataMapper($mapper);
    public function getValidator();
    public function setValidator($validator);
    public function getFilter();
    public function setFilter($filter);
    
    public function __get($attritbute);
    public function __set($attribute, $value);
    
    public function getData();
    public function setData(array $data);
    
    public function isValid(); //validates model
            
}
