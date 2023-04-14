<?php

class Block_Core_Layout extends Block_Core_Abstracts {
    public function __construct(){ //call parent in all class
        parent::__construct();
        $this->setTemplate('core/layout/3columns.phtml');
        // $this->setTemplate('core/layout/2columns.phtml');
        $this->prepareChildren();
	}

    

    public function prepareChildren() {

        $head = $this->createBlock('Head');
        $this->addChild('head', $head);

        $content = $this->createBlock('Content');
        $this->addChild('content', $content);

        $header = $this->createBlock('Header');
        $this->addChild('header', $header);

        $footer = $this->createBlock('Footer');
        $this->addChild('footer', $footer);

        $message = $this->createBlock('Message');
        $this->addChild('message',$message);

        $left = $this->createBlock('Left');
        $this->addChild('left',$left);

        $right = $this->createBlock('Right');
        $this->addChild('right',$right);
    }

    public function createBlock($blockname){
        // $head = new Block_Html_Head(); //make above dynamic 
        $blockClassname = 'Block_Html_'.$blockname;
        $block = new $blockClassname;
        // $block->setLayout($this); //make this changes and in gridAction attribut i wrote
        return $block;
    }
}

?>