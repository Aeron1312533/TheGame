<?php
/**
 * Description of Game_Model_Abstract
 *
 * @author peter.pekarovic
 */
abstract class Game_DataMapper_Abstract implements Game_DataMapper_Interface {
    protected $entityClass = NULL;
    protected $storageClass = NULL;
    protected $storage = NULL;
    
    protected static $instance;
    
    abstract function insert($model);
    abstract function update($model);
    abstract function delete($idOrModel);
    abstract function findById($id); //prerobit
    abstract function fetchAll(); 
    abstract function findByCondition($condition);
    
    final protected function __construct() {
        $this->init();
    }

    protected function init() {
        
    }
    
    public static function getInstance() {
       if (!self::$instance) {
           $className = get_called_class();
           self::$instance = new $className();
       } 
       
       return self::$instance;
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
    
    public function getEntityClass() {
        if(!isset($this->entityClass)) {
            throw new Game_DataMapper_Exception('DataMapper: entity not set');
        }
        
        return $this->entityClass;      
    }
    
    public function setEntityClass($entityClass) {
        $this->entityClass = $entityClass;
    }
    
    public function getStorageClass() {
        if(!isset($this->storageClass)) {
            throw new Game_DataMapper_Exception('DataMapper: storage class not set');
        }
        
        return $this->storageClass;      
    }
    
    public function setStorageClass($storagelClass) {
        $this->storageClass = $storagelClass;
    }
    
    public function createModelInstance() {
        
    }
}
