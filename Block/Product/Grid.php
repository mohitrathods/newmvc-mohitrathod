<?php


class Block_Product_Grid extends Block_Core_Abstracts {
    public function __construct(){ //call parent in all class
        parent::__construct();

        // $this->setTemplate('product/grid.phtml');
	}

    public function getCollection(){
        $query = "SELECT * FROM `product`";
        $products = Ccc::getModel('Product')->fetchAll($query);
        $this->setTemplate('product/grid.phtml')->setData(['products' => $products]);
        return $products;
    }
    

    

  
}

?>