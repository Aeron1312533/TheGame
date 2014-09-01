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
abstract class Game_DataMapper_Database extends Game_DataMapper_Abstract {
       
    public function insert() {
        try {
            $columns = $this->getStorage()->info(Zend_Db_Table_Abstract::COLS);
            $data = $this->getModel()->getData();
            
            foreach ($data as $column => $value) {
                if (!in_array($column, $columns)) {
                    unset($data[$column]);
                }
            }
            
            $row = $this->getStorage()->createRow($data);
            $id_row = $row->save();
        } catch (Zend_Db_Exception $e) {
            throw new Game_DataMapper_Exception('DataMapper: - DBERROR: ' . $e->getMessage());
        } catch (Game_DataMapper_Exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Game_DataMapper_Exception('DataMapper: - INTERNALERROR: ' . $e->getMessage());
        }
        
        return $id_row;
    }
    
    public function update() {
        try {
            $columns = $this->getStorage()->info(Zend_Db_Table_Abstract::COLS);
            $data = $this->getModel()->getData();
            $id_row = (Array) $this->getModel()->getId();
            
            foreach ($data as $column => $value) {
                if (!in_array($column, $columns)) {
                    unset($data[$column]);
                }
            }
            
            $storage = $this->getStorage();
            $rowset = call_user_func_array(Array($storage, 'find'), $id_row);
            $row = $rowset->current();
            $row->setFromArray($data);
            $row->save();
        } catch (Zend_Db_Exception $e) {
            throw new Game_DataMapper_Exception('DataMapper: - DBERROR: ' . $e->getMessage());
        } catch (Game_DataMapper_Exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Game_DataMapper_Exception('DataMapper: - INTERNALERROR: ' . $e->getMessage());
        }
        
        return true;
            
    }
    
    public function delete() {
        try {
            $id_row = (Array) $this->getModel()->getId();
            $storage = $this->getStorage();
            $rowset = call_user_func_array(Array($storage, 'find'), $id_row);
            $row = $rowset->current();
            $row->delete();
        } catch (Zend_Db_Exception $e) {
            throw new Game_DataMapper_Exception('DataMapper: - DBERROR: ' . $e->getMessage());
        } catch (Game_DataMapper_Exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Game_DataMapper_Exception('DataMapper: - INTERNALERROR: ' . $e->getMessage());
        }
        
        return true;
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
            $this->getModel()->setData($row->toArray());
            $id = array_intersect_key($this->getModel()->getData(), array_flip($storage->getPrimary())) ;           
            $this->getModel()->setId($id);
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
