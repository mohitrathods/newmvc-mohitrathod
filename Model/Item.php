<?php

class Model_Item extends Model_Core_Table {
	function __construct(){
        parent::__construct();
        $this->setResourceClass('Model_Item_Resource');
        $this->setCollectionClass('Model_Item_Collection');
    }
}