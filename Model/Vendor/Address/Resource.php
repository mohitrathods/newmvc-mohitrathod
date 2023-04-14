<?php

class Model_Vendor_Address_Resource extends Model_Core_Table_Resource {
     function __construct()
    {
        parent::__construct();
        
        $this->setResourceName('vendor_address')->setPrimaryKey('address_id');
    }
}

?>