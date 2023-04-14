
<?php

class Model_Item_Resource extends Model_Core_Table_Resource{
    function __construct()
    {
        parent::__construct();
        
        $this->setResourceName('item')->setPrimaryKey('item_id');
    }
}
?>