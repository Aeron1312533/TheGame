<?php
/**
 * Description of Game_Model_Abstract
 *
 * @author peter.pekarovic
 */
abstract class Game_DataMapper_Abstract implements Game_DataMapper_Interface {
    protected $model = NULL;
    protected $storage = NULL;
    
    abstract function insert();
    abstract function update();
    abstract function delete();
    abstract function findByID($id); //prerobit
    abstract function fetchAll(); 
    abstract function findByCondition($condition);
    
    public function init($model, $storage) {
        $this->setStorage($storage);
        $this->setModel($model);
    }
    
    public function getStorage() {
        if(!isset($this->storage)) {
            throw new Game_DataMapper_Exception('DataMapper: storage not set');
        }
        
        return $this->storage;      
    }
    
    public function setStorage($storage) {
        $this->storage = $storage;
    }
    
    public function getModel() {
        if(!isset($this->model)) {
            throw new Game_DataMapper_Exception('DataMapper: model not set');
        }
        
        return $this->model;      
    }
    
    public function setModel($model) {
        $this->model = $model;
    }
}
