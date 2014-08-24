<?php
/**
 * Description of Game_Model_Abstract
 *
 * @author peter.pekarovic
 */
abstract class Game_Model_Abstract implements Game_Model_Interface {
    protected $storage = NULL;
    protected $modelName = NULL;
    protected $data = Array();
    
    abstract public function insert();
    abstract public function update();
    abstract public function delete();
    abstract public function find($id);
    abstract public function fetchAll();
    
    public function getStorage() {
        if(!isset($this->storage)) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - storage not set');
        }
        
        return $this->storage;      
    }
    
    public function setStorage($storage) {
        $this->storage = $storage;
    }
    
    public function getData() {
        if(!isset($this->data)) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - data not set');
        }
        
        return $this->data;
    }
    
    public function setData($data) {
        $this->data = (Array) $data;
    }
    
    public function __get($attritbute) {
        $method = 'get' . ucfirst($attritbute);
        
        if (!method_exists($this, $method)) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - invalid property: ' . $attribute);
        }
        
        return $this->$method();
    }
    
    public function __set($attribute, $value) {
        $method = 'set' . ucfirst($attribute);
        
        if (!method_exists($this, $method)) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - invalid property: ' . $attribute);
        }
        
        $this->$method($value);
    }
}
