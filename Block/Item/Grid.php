<?php

class Block_Item_Grid extends Block_Core_Abstracts{
	public function __construct(){
		parent::__construct();

		$this->setTemplate('item/grid.phtml');
	}

	public function getCollection(){
		$query = "SELECT * FROM `item`";
		$items = Ccc::getModel('Item')->fetchAll($query);
		$this->setData(['items' => $items]);
		// return $items;

		if(!$items){
			return Ccc::getModel('Item');
		}
		else{
			return $items;
		}
	}
}

?>