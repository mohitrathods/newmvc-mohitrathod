<?php

class Block_Eav_Attribute_Option_Edit extends Block_Core_Abstracts {
    public function __construct(){
        parent::__construct();
        $this->setTemplate('eav/attribute/edit.phtml');
    }

    
}

?>