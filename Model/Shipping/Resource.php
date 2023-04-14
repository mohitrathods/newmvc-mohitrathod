<?php

class Model_Shipping_Resource extends Model_Core_Table_Resource{
    function __construct()
    {
        parent::__construct();
        
        $this->setResourceName('shipping')->setPrimaryKey('shipping_method_id');
    }
}