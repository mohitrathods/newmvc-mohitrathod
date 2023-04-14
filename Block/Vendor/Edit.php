<?php

class Block_Vendor_Edit extends Block_Core_Abstracts {
    public function __construct(){
        parent::__construct();
    }

    public function getCollection(){
        $id = Ccc::getModel('Core_Request')->getParam('id');

        if(!$id){
            $vendorRow = Ccc::getModel('Vendor');
            $addressRow = Ccc::getModel('Vendor_Address');
            $this->setTemplate('vendor/edit.phtml')->setData(['vendors' => $vendorRow]); 
        }

        else {
            $vendorRow = Ccc::getModel('Vendor')->load($id);
            $addressRow = Ccc::getModel('Vendor_Address')->load($id);
            $this->setTemplate('vendor/edit.phtml')->setData(['vendors' => $vendorRow]);
        }

        $final = [$vendorRow, $addressRow];
        return $final;
    }

}

?>