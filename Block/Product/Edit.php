<?php

class Block_Product_Edit extends Block_Core_Abstracts{

    public function __construct(){
        parent::__construct();

    }

    public function getCollection() {
        $id = Ccc::getModel('Core_Request')->getParam('id');

        if(!$id){
            $productRow = Ccc::getModel('Product');
            $this->setTemplate('product/edit.phtml')->setData(['products' => $productRow]);
        }

        else {
            $productRow = Ccc::getModel('Product')->load($id);
            $this->setTemplate('product/edit.phtml')->setData(['products' => $productRow]);
        }
        return $productRow;
    }
}

?>