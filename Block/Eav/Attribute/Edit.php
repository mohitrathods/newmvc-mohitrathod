<?php

class Block_Eav_Attribute_Edit extends Block_Core_Abstracts {
    public function __construct(){
        parent::__construct();
    }

    public function getCollection() {
        $id = Ccc::getModel('Core_Request')->getParam('id');

        if(!$id){
            $attributeRow = Ccc::getModel('Eav_Attribute');
            $this->setTemplate('eav/attribute/edit.phtml')->setData(['attributes' => $attributeRow]);
        }

        else{
            $attributeRow = Ccc::getModel('Eav_Attribute')->load($id);
            $this->setTemplate('eav/attribute/edit.phtml')->setData(['attributes' => $attributeRow]);
        }

        return $attributeRow;
    }
}

?>