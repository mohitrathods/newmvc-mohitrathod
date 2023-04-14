<?php
require_once 'Core/Table.php';
class Model_Category extends Model_Core_Table{
    // protected $tableName = 'category';
    // protected $primaryKey = 'category_id';

    function __construct()
	{
		parent::__construct();
		
		$this->setTableName('category')->setPrimaryKey('category_id');
	}
}
?>

