<?php

class Model_Admin extends Model_Core_Table {
	function __construct(){
        parent::__construct();
        $this->setResourceClass('Model_Admin_Resource');
        $this->setCollectionClass('Model_Admin_Collection');
    }

    // function __construct()
	// {
	// 	parent::__construct();
		
	// 	$this->setResourceName('admin')->setPrimaryKey('admin_id');
	// }
}