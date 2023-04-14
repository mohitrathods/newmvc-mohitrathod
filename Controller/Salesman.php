<?php

require_once 'Controller/Core/Action.php';
require_once 'Model/Salesman.php';
require_once 'Model/Core/Url.php';

class Controller_Salesman extends Contoller_Core_Action{
    protected $salesman = [];

    protected $salesmanId = null;

    protected $model = null;

    //------------ get salesman and set salesman

    public function setSalesMan($salesman){
        $this->salesman = $salesman;
        return $this;
    }

    public function getSalesMan(){
        return $this->salesman;
    }

    //------------ get model and set model
    public function setModel($model){
        $this->model = $model;
        return $this;
    }

    public function getModel(){
        if($this->model){
            return $this->model;
        }
        $model = new Model_Salesman();
        $this->model = $model;
        return $model;
    }

    public function gridAction(){
         $query = "SELECT * FROM `salesman` WHERE 1";
        $salesman = $this->getModel()->fetchAll($query);
        
        $this->setSalesMan($salesman);

        $this->getTemplate("salesman/grid.phtml");
    }

    public function addAction(){
        $this->getTemplate("salesman/add.phtml");
    }

    public function insertAction(){
        $salesman = $this->getRequest()->getPost('salesman');

        date_default_timezone_set("Asia/Kolkata");
        $dateTime = date("Y-m-d h:i:sA");
        $salesman['created_at'] = $dateTime;

        $this->getModel()->insert($salesman);

        $this->redirect('salesman', 'grid');

    }

    public function editAction(){
        $query = "SELECT * FROM `salesman` WHERE `salesman_id` = '{$this->getRequest()->getParam('id')}'";

        $salesmanRow = $this->getModel()->fetchRow($query);

        $this->setSalesMan($salesmanRow);

        $this->getTemplate("salesman/edit.phtml");
    }

    public function updateAction(){
        $salesman = $this->getRequest()->getPost('salesman');

        date_default_timezone_set("Asia/Kolkata");
        $dateTime = date("Y-m-d h:i:sA");
        $salesman['updated_at'] = $dateTime;

        $salesmanId = $this->getRequest()->getParam('id');

        $condition['salesman_id'] = $salesmanId;
        
        $this->getModel()->update($salesman, $condition);

        $this->redirect('salesman' ,'grid' , [] , true);
    }

    public function deleteAction (){
        $deleteId = $this->getRequest()->getParam('id');

        $this->getModel()->delete($deleteId);

        $this->redirect('salesman' ,'grid' , [] , true);

    }

    

}
?>