<?php

class Block_Customer_Edit extends Block_Core_Abstracts {
    public function __construct(){
        parent::__construct();
    }

    public function getCollection(){
        $id = Ccc::getModel('Core_Request')->getParam('id');

        if(!$id){
            $customerRow = Ccc::getModel('Customer');
            $addressRow = Ccc::getModel('Customer_Address');
            $this->setTemplate('customer/edit.phtml')->setData(['customers' => $customerRow]); 
        }

        else {
            $customerRow = Ccc::getModel('Customer')->load($id);
            $addressRow = Ccc::getModel('Customer_Address')->load($id);
            $this->setTemplate('customer/edit.phtml')->setData(['customers' => $customerRow]);
        }

        $final = [$customerRow, $addressRow];
        return $final;
    }

}

?>