<?php

class Block_Html_Head extends Block_Core_Abstracts {
    public function __construct(){
        parent::__construct();
        $this->setTemplate('html/head.phtml');
    }
}

?>