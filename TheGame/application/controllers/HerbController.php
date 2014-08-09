<?php

class HerbController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $herbs = new Application_Model_DbTable_Herb();
        $this->view->herbs = $herbs->fetchAll();
    }

    public function addAction()
    {
        $form = new Application_Form_Herb();

        $form->submit->setLabel('Add Herb');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            
            /**
             * if back button was pressed
             */
            if(isset($formData["back"])) {
                $this->_helper->redirector('index');
            }
            
            if ($form->isValid($formData)) {
                $name = $form->getValue('name');
                $title = $form->getValue('title');
                $albums = new Application_Model_DbTable_Herb();
                $albums->addHerb($name);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function editAction()
    {
        $form = new Application_Form_Herb();
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            
            /**
             * if back button was pressed
             */
            if(isset($formData["back"])) {
                $this->_helper->redirector('index');
            }
            
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id_herb');
                $name = $form->getValue('name');
                $albums = new Application_Model_DbTable_Herb();
                $albums->updateHerb($id, $name);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else { //zobrazujeme
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $herb = new Application_Model_DbTable_Herb();
                $form->populate($herb->getHerb($id));
            }
        }
    }

    public function deleteAction()
    {
        $form = new Application_Form_HerbDelete();
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            
            if(isset($formData["No"])) {
                $this->_helper->redirector('index');
            }
            
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id_herb');
                $herb = new Application_Model_DbTable_Herb();
                $herb->deleteHerb($id);
            }
            
            $this->_helper->redirector('index');
        } else { //zobrazujeme
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $herb = new Application_Model_DbTable_Herb();
                $form->populate($herb->getHerb($id));
            }
        }
    }


}







