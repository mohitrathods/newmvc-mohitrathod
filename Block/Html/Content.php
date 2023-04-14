<?php


class Block_Html_Content extends Block_Core_Abstracts {
    public function __construct(){ //call parent in all class
        parent::__construct();
        $this->setTemplate('html/content.phtml');
	}

  
}

?>