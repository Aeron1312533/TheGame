<?php

class Application_Form_Herb extends Zend_Form
{

    public function init()
    {
        $this->setName('herb');

        $id = new Zend_Form_Element_Hidden('id_herb');
        $id->addFilter('Int');

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        
        $back = new Zend_Form_Element_Submit('back');
        $back->setAttrib('id', 'backbutton');
        

        $this->addElements(array($id, $name, $back, $submit));
    }


}

