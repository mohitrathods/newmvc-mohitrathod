<?php

class Model_Product_Media extends Model_Core_Table {
	function __construct(){
        parent::__construct();
        $this->setResourceClass('Model_Product_Media_Resource');
        $this->setCollectionClass('Model_Product_Media_Collection');
    }
}