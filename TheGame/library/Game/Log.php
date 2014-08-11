<?php

class Game_Log extends Zend_Log {
    
    public function _construct() {
        parent::__construct();
    }
    
    public function addWriterUnique($writer) {
        if (is_array($writer) || $writer instanceof  Zend_Config) {
            $writer = $this->_constructWriterFromConfig($writer);
        }

        if (!$writer instanceof Zend_Log_Writer_Abstract) {
            /** @see Zend_Log_Exception */
            require_once 'Zend/Log/Exception.php';
            throw new Zend_Log_Exception(
                'Writer must be an instance of Zend_Log_Writer_Abstract'
                . ' or you should pass a configuration array'
            );
        }

        if(!in_array($writer, $this->_writers)) {
            $this->_writers[] = $writer;
        }
        return $this;
    }
}

