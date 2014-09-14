<?php

class OverviewController extends Game_Controller_Action
{

    public function init() {
        parent::init();
        /* Initialize action controller here */
    }

    public function indexAction() {
      // $this->view->message= "prihlaseny";
        
      $model = new Application_Model_Entity_User();
      $this->view->bla = $model->getData();
       
    }

}
