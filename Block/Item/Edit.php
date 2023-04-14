<?php

class Block_Item_Edit extends Block_Core_Abstracts {

	public function __construct(){
		parent::__construct();

		$this->setTemplate('item/edit.phtml');
	}

	public function getCollection() {
		$id = Ccc::getModel('Core_Request')->getParam('id');

		if(!$id){
			$items = Ccc::getModel('Item');
			$this->setData(['items' => $items]);
		}
		else {
			$items = Ccc::getModel('Item')->load($id);
			$this->setData(['items' => $items]);
		}

		return $items;
	}
}

?>