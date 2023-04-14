<?php

class Model_Payment_Resource extends Model_Core_Table_Resource{
    function __construct()
    {
        parent::__construct();
        
        $this->setResourceName('payment')->setPrimaryKey('payment_method_id');
    }
    
    // function __construct(){
    //     parent::__construct();
    //     $this->setResourceName('Model_Admin');
    // }


    // public function getStatusText()
	// {
	// 	$statuses = $this->getTable()->getStatusOptions();
	// 	if (array_key_exists($this->status, $statuses))
	// 	{
	// 		return $statuses[$this->status];
	// 	}

	// 	return $statuses[Model_Admin::STATUS_DEFAULT];
	// }
}