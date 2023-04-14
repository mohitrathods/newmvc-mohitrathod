<?php

class Model_Admin_Resource extends Model_Core_Table_Resource{
    function __construct()
    {
        parent::__construct();
        
        $this->setResourceName('admin')->setPrimaryKey('admin_id');
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