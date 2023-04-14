<?php

class Model_Eav_Attribute extends Model_Core_Table {
    public function __construct(){
        parent::__construct();

        $this->setResourceClass('Model_Eav_Attribute_Resource');
        $this->setCollectionClass('Model_Eav_Attribute_Collection');
    }
}

?>