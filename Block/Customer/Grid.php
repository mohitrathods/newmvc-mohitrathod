<?php

class Block_Customer_Grid extends Block_Core_Abstracts {
    public function __construct(){
        parent::__construct();
    }

    public function getCollection(){
        $query = "SELECT * FROM `customer`";
        $customers = Ccc::getModel('Customer')->fetchAll($query);
        $this->setTemplate('customer/grid.phtml')->setData(['customers' => $customers]);
        return $customers;
    }
}

?>