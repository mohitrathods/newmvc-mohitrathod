<?php

class Block_Vendor_Grid extends Block_Core_Abstracts {
    public function __construct(){
        parent::__construct();
    }

    public function getCollection(){
        $query = "SELECT * FROM `vendor`";
        $vendors = Ccc::getModel('Vendor')->fetchAll($query);
        $this->setTemplate('vendor/grid.phtml')->setData(['vendors' => $vendors]);
        return $vendors;
    }
}

?>