<?php

class ErrorController extends Zend_Controller_Action {
    protected $logPath = NULL;
    protected $errors;
    protected $logRootDir;
    protected $logRelativeDir;
    protected $logPriority;
    
    public function init() {
        $this->errors = $this->_getParam('error_handler');
        $this->logRootDir = APPLICATION_PATH . '/../data/logs/';
    }
    
    public function errorAction() {      
        $saveError = true;
        
        //if error action was called without error
        if (!$this->errors  || !$this->errors  instanceof ArrayObject) {
            $this->view->message = 'You have reached the error page';
            return;
        }
        
        switch ($this->errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found - invalid URL
                $this->getResponse()->setHttpResponseCode(404);
                $this->logPriority = Zend_Log::NOTICE;
                $this->view->message = 'Page not found';
                $this->logRelativeDir = '_other';
                $saveError = false;
                break;
            default:
                // application error
                $this->getResponse()->setHttpResponseCode(500);
                $this->logPriority = Zend_Log::CRIT;
                $this->view->message = 'Application error';
                $this->logRelativeDir = $this->errors->request->getModuleName() . '/' . 
                                        $this->errors->request->getControllerName() . '/' .
                                        $this->errors->request->getActionName();
                break;
        }
        
        if ($saveError) {
            $this->_createLogPath();
        
            // Log exception, if logger available
            $log = $this->_createLog();
            $log->log($this->view->message, $this->logPriority, $this->errors->exception);
            $log->log('Request Parameters', $this->logPriority, $this->errors->request->getParams());
        }
        
        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $this->errors->exception;
        }
        
        $this->view->request   = $this->errors->request;
    }

    protected function _createLog() {
        if (!is_dir($path = $this->_getDirPath())) {
            mkdir($path, 0700, true);
        }
        
        $writer = new Zend_Log_Writer_Stream($this->logPath);
        $formatter = new Zend_Log_Formatter_Xml();
        $writer->setFormatter($formatter);     
        
        $log = new Game_Log($writer);
        $log->addWriterUnique($writer);
        
        return $log;
    }

    protected function _getDirPath() {
        $date = new Zend_Date();
        $logDir = $date->get('YYYY-MM-dd');
        
        return $this->logRootDir . $this->logRelativeDir . '/' . $logDir;
    }
    
    protected function _getFileName() {
        $date = new Zend_Date();
        $guid = new Game_Guid();
        $user = 'nouser';
        
        if (Zend_Auth::getInstance()->hasIdentity()) {
            $user = Zend_Auth::getInstance()->getIdentity()->email;
        } 
        
        $reflection = new ReflectionClass('Game_Log');
        $priority = array_search($this->logPriority, $reflection->getConstants());
        
        return $date->get('HH-mm-ss') . '-' . $priority . '-' . $user . '-' . $guid . '.txt';     
    }
    
    protected function _createLogPath() {
        $this->logPath = $this->_getDirPath() . '/' . $this->_getFileName();
    }

}

