<?php

class Block_Html_Left extends Block_Core_Abstracts {
    public function __construct(){
        parent::__construct();
        $this->setTemplate('html/left.phtml');
    }
}

?>