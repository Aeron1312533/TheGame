<?php

class ErrorController extends Zend_Controller_Action
{

    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');
        $logPath = NULL;
        
        $date = new Zend_Date();
        $time = $date->get('YYYY-MM-dd-HH-mm-ss');
                
        
        if (!$errors || !$errors instanceof ArrayObject) {
            $this->view->message = 'You have reached the error page';
            return;
        }
        
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $priority = Zend_Log::NOTICE;
                $this->view->message = 'Page not found';
                $logPath = APPLICATION_PATH . '/../data/logs/_other/log.txt';
                break;
            default:
                // application error
                $this->getResponse()->setHttpResponseCode(500);
                $priority = Zend_Log::CRIT;
                $this->view->message = 'Application error';
                break;
        }
        
        // Log exception, if logger available
        if ($log = $this->getLog()) {
            $log->log($this->view->message, $priority, $errors->exception);
            $log->log('Request Parameters', $priority, $errors->request->getParams());
        } else {
            if(is_null($logPath)) {
                $controller = $errors->request->getControllerName();
                $module = $errors->request->getModuleName();
                $action = $errors->request->getActionName();
                
                $logPath = APPLICATION_PATH . '/../data/logs/' . $module . '/' . $controller . '/' . $action . '/' . $time . '.txt';
            }

            $writer = new Zend_Log_Writer_Stream($logPath);
            $formatter = new Zend_Log_Formatter_Xml();
            $writer->setFormatter($formatter);
            
            $filter = new Zend_Log_Filter_Priority(Zend_Log::CRIT);


            $log = new Game_Log($writer);
            $log->addWriterUnique($writer);
            $log->addFilter($filter);
            
            $log->log($this->view->message, $priority, $errors->exception);
            $log->log('Request Parameters', $priority, $errors->request->getParams());
        }
        
        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $errors->exception;
        }
        
        $this->view->request   = $errors->request;
    }

    public function getLog()
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }


}

