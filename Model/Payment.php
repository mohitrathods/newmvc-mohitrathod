<?php

// require_once 'Core/Table.php';

class Model_Payment extends Model_Core_Table{
    function __construct()
	{
		parent::__construct();
		
		// $this->setResourceName('payment')->setPrimaryKey('payment_method_id');
		$this->setResourceClass('Model_Payment_Resource');
        $this->setCollectionClass('Model_Payment_Collection');
	}
}
?>