<?php

class Block_Product_Media_Edit extends Block_Core_Abstracts {
    public function __construct(){
        parent::__construct();
    }

    public function getCollection() {
        $addMedia = Ccc::getModel('Product_Media');
        $this->setTemplate('product_media/add.phtml')->setData(['productmedias' => $addMedia]);
        return $addMedia;
    }
}

?>