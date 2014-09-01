<?php
/**
 * Description of Game_Model_Abstract
 *
 * @author peter.pekarovic
 */
abstract class Game_Model_Abstract implements Game_Model_Interface {
    protected $dataMapper = NULL;
    protected $modelName = NULL;
    protected $validator = NULL;
    protected $filter = NULL;
    protected $data = Array();
    
    public function getDataMapper() {
        if(!isset($this->dataMapper)) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - data mapper not set');
        }
        
        return $this->dataMapper;      
    }
    
    public function setDataMapper($dataMapper) {
        $this->dataMapper = $dataMapper;
    }
    
    public function getValidator() {
        if(!isset($this->validator)) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - validator not set');
        }
        
        return $this->validator;      
    }
    
    public function setValidator($validator) {
        $this->validator = $validator;
    }
    
    public function getFilter() {
        if(!isset($this->filter)) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - filter not set');
        }
        
        return $this->filter;      
    }
    
    public function setFilter($filter) {
        $this->filter = $filter;
    }
    
    public function getData() {
        if (!isset($this->data)) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - data not set');
        }
        
        return $this->data;
    }
    
    public function setData(array $data) {
       $methods = get_class_methods($this);
       
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
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
    
    public function isValid() {
        return $this->getValidator()->isValid();
    }
}
