<?php

class Block_Html_Header extends Block_Core_Abstracts {
    public function __construct(){
        parent::__construct();
        $this->setTemplate('html/header.phtml');
    }
}

?>