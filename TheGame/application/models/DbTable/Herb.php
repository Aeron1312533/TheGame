<?php

class Application_Model_DbTable_Herb extends Zend_Db_Table_Abstract
{

    protected $_name = 'herb';
    protected $_primary = 'id_herb';

    public function getHerb($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id_herb = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addHerb($name)
    {
        $data = array(
            'name' => $name,
        );
        
        $this->insert($data);
    }

    public function updateHerb($id, $name)
    {
        $data = array(
            'name' => $name
        );
        $this->update($data, 'id_herb = '. (int)$id);
    }

    public function deleteHerb($id)
    {
        $this->delete('id_herb =' . (int)$id);
    }

}

