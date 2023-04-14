<?php

class Block_Shipping_Grid extends Block_Core_Abstracts {
    public function __construct(){
        parent::__construct();

    }

    public function getCollection(){
        $query = "SELECT * FROM `shipping`";
        $shippings = Ccc::getModel('Shipping')->fetchAll($query);
        $this->setTemplate('shipping/grid.phtml')->setData(['shippings' => $shippings]);
        return $shippings;
    }
}

?>