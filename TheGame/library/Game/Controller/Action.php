<?php


class Game_Controller_Action extends Zend_Controller_Action {
    
    private $_acl = null;
    
    public function _construct() {
        parent::__construct();
        
    }
    
    public function preDispatch() {
        //get request information
        $resource = $this->getRequest()->getControllerName ();
        $action = $this->getRequest()->getActionName ();

        //check permissions
        $acl = Zend_Registry::get('acl');
        if(!$acl->isAllowed(Zend_Registry::get('role'), $resource, $action)){
            $this->_forward("login", "user");
        }
        
        //default navigations
        $this->view->navigation_main = Zend_Registry::get('navigation-main');
        $this->view->navigation_user = Zend_Registry::get('navigation-user');
    }
    
    public function init() {
    }
}