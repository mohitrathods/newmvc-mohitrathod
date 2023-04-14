<?php


class Block_Product_Media_Grid extends Block_Core_Abstracts {
    public function __construct(){ //call parent in all class
        parent::__construct();

	}

    public function getCollection(){
        $productId = Ccc::getModel('Core_Request')->getParam('id');
        $query = "SELECT * FROM `product_media` WHERE `product_id` = $productId";
        $productmedias = Ccc::getModel('Product_Media')->fetchAll($query);
        $this->setTemplate('product_media/grid.phtml')->setData(['productmedias' => $productmedias]);
        return $productmedias;
    }
    

    

  
}

?>
