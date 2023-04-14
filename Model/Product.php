<?php

class Model_Product extends Model_Core_Table {
	function __construct(){
        parent::__construct();
        $this->setResourceClass('Model_Product_Resource');
        $this->setCollectionClass('Model_Product_Collection');
    }
}