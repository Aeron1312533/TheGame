<?php

class Application_Form_HerbDelete extends Zend_Form
{

    public function init()
    {
        $this->setName('herb_delete');

        $id = new Zend_Form_Element_Hidden('id_herb');
        $id->addFilter('Int');

        $yes = new Zend_Form_Element_Submit('Yes');
        $yes->setAttrib('id', 'submitbuttonyes');
        
        $no = new Zend_Form_Element_Submit('No');
        $no->setAttrib('id', 'submitbuttonno');
        

        $this->addElements(array($id, $yes, $no));
    }


}

