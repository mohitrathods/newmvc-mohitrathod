<?php

class Model_Vendor extends Model_Core_Table {
	function __construct(){
        parent::__construct();
        $this->setResourceClass('Model_Vendor_Resource');
        $this->setCollectionClass('Model_Vendor_Collection');
    }
}