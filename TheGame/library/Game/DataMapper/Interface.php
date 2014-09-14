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
interface Game_DataMapper_Interface {   
    public function insert($entity);
    public function update($entity);
    public function delete($idOrEntity);
    public function findById($id);
    public function fetchAll();
    public function findByCondition($condition);
}
