<?php

require_once 'Model/Core/Table/Row.php';

class Model_Category_Row extends Model_Core_Table_Row {
    function __construct(){
            parent::__construct();
            $this->setTableClass('Model_Category');
        }
    // protected $tableName = 'category';

    // protected $primaryKey = 'category_id';

    // protected $tableClass = 'Model_Category';   

    
}

?>