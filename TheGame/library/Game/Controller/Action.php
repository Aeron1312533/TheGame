<?php


class Game_Controller_Action extends Zend_Controller_Action {
    
    public function _construct() {
        parent::__construct();
    }
    
    public function init() {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_helper->redirector('login', 'user');
        }
    }
}