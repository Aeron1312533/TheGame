<?php
/**
 * Description of Game_Model_Abstract
 *
 * @author peter.pekarovic
 */
abstract class Game_Entity_Abstract implements Game_Entity_Interface {
    protected $entityName = NULL;
    protected $data = Array();
   
    final public function __construct(array $data = NULL) {        
        if (!is_null($data)) {
            $this->setData($data);
        }
        
        $this->init();
    }
    
    protected function init() {
        
    }
    
    public function getData() {
        return $this->data;
    }
    
    public function setData(array $data) {
        foreach ($data as $name => $value) {
            if (array_key_exists($name, $this->data)) {
                $this->{$name} = $value;
            }
        }     
    }
    
    public function __get($name) {
        if (array_key_exists($name, $this->_data)) {
            return $this->data[$name];                  
        }
    }
    
    public function __set($name, $value) {
        if (!array_key_exists($name, $this->data)) {
            throw new Game_Entity_Exception('Property:' . $name . ' of model:' . $this->entityName . ' does not exist');
        }
        
        $filteredValue = $this->filter($name, $value);
        
        if (!$this->isValid($name, $filteredValue)) {
            throw new Game_Entity_Exception('Model:' . $this->entityName . ' , invalid value: ' . $filteredValue . ' of property:' . $name);
        }
        
        $this->data[$name] = $filteredValue;
    }
    
    public function __isset($name) {
        return isset($this->data[$name]);
    }     
    
    public function __unset($name) {
        if (isset($this->data[$name])) {
            unset($this->data[$name]);
        }
    } 
    
    abstract function filter($name, $value);
    abstract function isValid($name, $filteredValue);
}
