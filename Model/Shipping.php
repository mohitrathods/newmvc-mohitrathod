<?php
// require_once "Core/Table.php";

class Model_Shipping extends Model_Core_Table{

   function __construct()
	{
		parent::__construct();
		
		// $this->setResourceName('shipping')->setPrimaryKey('shipping_method_id');
		$this->setResourceClass('Model_Shipping_Resource');
        $this->setCollectionClass('Model_Shipping_Collection');
	}
}

?>