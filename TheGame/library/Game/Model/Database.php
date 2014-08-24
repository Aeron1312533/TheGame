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
abstract class Game_Model_Database extends Game_Model_Abstract {
    
    protected function _preInsert() {
        
    }
    
    public function insert() {
        try {
            $columns = $this->getStorage()->info(Zend_Db_Table_Abstract::COLS);
            
            foreach ($this->data as $column => $value) {
                if (!in_array($column, $columns)) {
                    unset($this->data[$column]);
                }
            }
            
            $this->_preInsert();
            $row = $this->getStorage()->createRow($this->data);
            $id_row = $row->save();
            $this->_postInsert();
        } catch (Zend_Db_Exception $e) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - DBERROR: ' . $e->getMessage());
        } catch (Game_Model_Exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - INTERNALERROR: ' . $e->getMessage());
        }
        
        return $id_row;
    }
    
    protected function _postInsert() {
        
    }
    
    protected function _preUpdate() {
        
    }
    
    public function update() {
        try {
            $columns = $this->getStorage()->info(Zend_Db_Table_Abstract::COLS);
            $id_row = (Array) $this->getId();
            
            foreach ($this->data as $column => $value) {
                if (!in_array($column, $columns)) {
                    unset($this->data[$column]);
                }
            }
            
            $storage = $this->getStorage();
            $rowset = call_user_func_array(Array($storage, 'find'), $id_row);
            $row = $rowset->current();
            $this->_preUpdate();
            $row->setFromArray($this->data);
            $row->save();
            $this->_postUpdate();
        } catch (Zend_Db_Exception $e) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - DBERROR: ' . $e->getMessage());
        } catch (Game_Model_Exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - INTERNALERROR: ' . $e->getMessage());
        }
        
        return true;
            
    }
    
    protected function _postUpdate() {
        
    }
    
    protected function _preDelete() {
        
    }
    
    public function delete() {
        try {
            $id_row = (Array) $this->getId();
            $storage = $this->getStorage();
            $rowset = call_user_func_array(Array($storage, 'find'), $id_row);
            $row = $rowset->current();
            $this->_preDelete();
            $row->delete();
            $this->_postDelete();
        } catch (Zend_Db_Exception $e) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - DBERROR: ' . $e->getMessage());
        } catch (Game_Model_Exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - INTERNALERROR: ' . $e->getMessage());
        }
        
        return true;
    }
    
    protected function _postDelete() {
        
    }
    
    public function fetchAll() {
        return $this->getStorage()->fetchAll()->toArray();
    }
    
    public function find($id) {
        $id_row = (Array) $id;
        $storage = $this->getStorage();
        $rowset = call_user_func_array(Array($storage, 'find'), $id_row);
        $row = $rowset->current();
        
        if (!is_null($row)) {
            $this->setData($row->toArray());
            $id = array_intersect_key($this->data, array_flip($storage->getPrimary())) ;           
            $this->setId($id);
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function getId() {
        if(!isset($this->data['id'])) {
            throw new Game_Model_Exception('Model: ' . $this->modelName . ' - id not set');
        }
        
        return $this->data['id'];
    }
    
    public function setId($id) {
        $this->data['id'] = $id;
    }
}
