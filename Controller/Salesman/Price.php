<?php

use function PHPSTORM_META\type;

require_once 'Model/Core/Request.php';
require_once 'Controller/Core/Action.php';
require_once 'Model/Salesman/Price.php';

class Controller_Salesman_Price extends Contoller_Core_Action {
    
    protected $salesmanPrice = null;
	
    protected $salesmanPriceId = null;
	
    protected $salesmanPriceModel = null;

    //-------------------------- salesman price set get
    public function setSalesmanPrice($salesmanprice){
        $this->salesmanPrice = $salesmanprice;
        return $this;
    }

    public function getSalesmanPrice(){
        return $this->salesmanPrice;
    }


    //-------------------- set get salesman price model
    public function setSalesmanPriceModel($salesmanpricemodel){
        $this->salesmanPriceModel = $salesmanpricemodel;
        return $this;
    }

    public function getSalesmanPriceModel(){
        if($this->salesmanPriceModel){
            return $this->salesmanPriceModel;
        }
        $salesManPriceModel = new Model_Salesman_Price();
        $this->setSalesmanPriceModel($salesManPriceModel);
        return $salesManPriceModel;
    }

    //------------------------- set get salesman price id
    public function setSalesmanPriceId($salesmanpriceid){
        $this->salesmanPriceId = $salesmanpriceid;
        return $this;
    }

    public function getSalesmanPriceId(){
        return $this->salesmanPriceId;
    }

    //-------------------------------------------------------- METHODS

    public function gridAction(){

        $salesmanId = $this->getRequest()->getParam('id');
        $this->setSalesmanPriceId($salesmanId);

        $query = "SELECT * FROM `salesman` ORDER BY `first_name` ASC";
        $salesmans = $this->getSalesmanPriceModel()->fetchAll($query);

        // print_r($salesmans);

        $query = "SELECT P.*, SP.salesman_price FROM `product` P LEFT JOIN `salesman_price` SP ON P.product_id=SP.product_id AND SP.salesman_id = {$salesmanId}";
		$salesmanPrices = $this->getSalesmanPriceModel()->fetchAll($query);
        // print_r($salesmanPrices);

		$array = [$salesmanPrices, $salesmans];
		// print_r($array);

		$this->setSalesmanPrice($array);
        

        $this->getTemplate('salesman_price/grid.phtml');
    }

    public function updateAction() {
        $salesmanId = $this->getRequest()->getParam('id');
        $salesmanPricePost = $this->getRequest()->getPost('sprice');
        print_r($salesmanPricePost);

        foreach ($salesmanPricePost as $productId => $salesmanPrice) {

            echo "<pre>";

            $query = "SELECT * FROM `salesman_price` WHERE `salesman_id` = {$salesmanId} AND `product_id` = {$productId}";
			$result = $this->getSalesmanPriceModel()->fetchRow($query);
            print_r($result);

            if (!is_null($result['salesman_price'])) {  
				if(!is_null($salesmanPrice)){
					$salesmanPriceInsert['salesman_id'] = $salesmanId;
					$salesmanPriceInsert['product_id'] = $productId;
					$salesmanPriceInsert['salesman_price'] = $salesmanPrice;

				$insertQuery = $this->getSalesmanPriceModel()->insert($salesmanPriceInsert);
				}
			}
            else{
				$salesmanPriceUpdate['salesman_price'] = $salesmanPrice;
				$condition['entity_id'] = $result['entity_id'];

				$updateQuery = $this->getSalesmanPriceModel()->update($salesmanPriceUpdate, $condition);
			}
        }

		// $this->redirect('index.php?c=salesman_price&a=grid');
        $this->redirect("index.php?c=product&a=grid");


    }

    public function deleteAction(){
        $salesmanId = $this->getRequest()->getParam('salesman_id');
		$productId = $this->getRequest()->getParam('product_id');

		$conditions['salesman_id'] = $salesmanId;
		$conditions['product_id'] = $productId;

		$this->getSalesmanPriceModel()->delete($conditions);

		$this->redirect("index.php?c=salesman&a=grid");

    }

}

?>