<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Languages
 *
 * @author peter.pekarovic
 */
class Game_Controller_Action_Helper_SetLanguages extends Zend_Controller_Action_Helper_Abstract {
    protected $formClassName = 'Application_Form_User_Languages';
    
    public function direct() {
        $this->generateForm($this->formClassName);
        $this->processForm($this->getRequest()->getPost());
    }
    
    public function generateForm($formClassName) {
        $view = $this->getActionController()->view;
        $view->assign('formLanguages', new $formClassName);
    }
    
    public function processForm($post) {
        if (isset($post["language"])) {
                $ns = new Zend_Session_Namespace('localization');
                $ns->language = $this->getRequest()->getPost("language");
                $this->getActionController()->getHelper('redirector')
                                            ->direct($this->getRequest()->getActionName());
            }
    }
}
