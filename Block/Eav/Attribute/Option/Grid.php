<?php
class Block_Eav_Attribute_Option_Grid extends Block_Core_Abstracts{
    public function __construct(){
        parent::__construct();
        $this->setTemplate('eav/attribute/grid.phtml');
    }

   
}

?>