<?php

class login_LoginController extends Game_Controller_Action
{

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
       $form = new Login_Form_Login();
       $this->view->form = $form;
       
       if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            
            if (isset($formData["register"])) {
                $this->_helper->redirector('register');
            }
            
            if ($form->isValid($formData)) {
                if($this->_processAuth($formData)) {
                    //$salt = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 16);
                    $this->_helper->redirector('index', 'overview','overview');
                } else {
                    Zend_Auth::getInstance()->clearIdentity();
                    $form->getElement('password')->addError('Incorrect login or password, try again !');
                }
            } else {
                $form->populate($formData);
            }
        }
       
    }
    
    public function registerAction() {
        $this->_helper->redirector('index');
    }
    
    public function forgotPasswordAction() {
        $this->_helper->redirector('index');
    }

    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index');
    }
    
    protected function _getAuthAdapter() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($db);

        $authAdapter->setTableName('user');
        $authAdapter->setIdentityColumn('email');
        $authAdapter->setCredentialColumn('password');
        $authAdapter->setCredentialTreatment('SHA1(CONCAT(?,password_salt))');

        return $authAdapter;
    }
    
    protected function _processAuth($formData) {
        $authAdapter = $this->_getAuthAdapter();       
        $authAdapter->setIdentity($formData['username']);
        $authAdapter->setCredential($formData['password']);
        
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($authAdapter);
        
        if ($result->isValid()) {
            $user = $authAdapter->getResultRowObject();
            $auth->getStorage()->write($user);
            return true;
        }
        
        return false;
    }

}

