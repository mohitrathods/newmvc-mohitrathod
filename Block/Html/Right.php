<?php

class Block_Html_Right extends Block_Core_Abstracts {
    public function __construct(){
        parent::__construct();
        $this->setTemplate('html/right.phtml');
    }
}

?>