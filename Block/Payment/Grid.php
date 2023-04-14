<?php


class Block_Payment_Grid extends Block_Core_Abstracts {

    protected $columns = [];
    protected $actions = [];

    public function __construct(){ //call parent in all class
        parent::__construct();
        $this->setTemplate('payment/grid.phtml');
        $this->prepareColumns();
        $this->prepareActions();
        echo "<pre>";
        print_r($this->columns);
	}

    public function setColumns(array $columns){
        $this->columns = $columns;
        return $this;
    }

    public function getColumns(){
        return $this->columns;
    }

    public function addColumn($key, $value){
        $this->columns[$key] = $value;
        return $this;
    }

    public function removeColumn($key){
        unset($this->columns[$key]);
        return $this;
    }

    public function getColumn($key){
        if(array_key_exists($key, $this->columns)){
            return $this->columns[$key];
        }
        return null;
    }

    public function prepareColumns(){
        $this->addColumn(
            'payment_method_id',['title' => 'Payment Id']
        );

        $this->addColumn(
            'name',['title' => 'Name']
        );

        $this->addColumn(
            'amount',['title' => 'Amount']
        );
        
        $this->addColumn(
            'status',['title' => 'Status']
        );
        
        $this->addColumn(
            'created_at',['title' => 'Created At']
        );

        $this->addColumn(
            'updated_at',['title' => 'Updated At']
        );

        $this->addColumn(
            'edit',['title' => 'Edit']
        );

        $this->addColumn(
            'delete',['title' => 'Delete']
        );
    }

    public function addAction($key, $value){
        $this->actions[$key] = $value;
        return $this;
    }

    public function getActions(){
        return $this->actions;
    }

    public function prepareActions(){
        $this->addAction(
            'edit',['title' => 'Edit']
        );

        $this->addAction(
            'delete',['title' => 'Delete']
        );
    }

    public function getCollection(){
        //set data here and call collection in construct above
        $query = "SELECT * FROM `payment`";
        $payments = Ccc::getModel('Payment')->fetchAll($query);
        // print_r($payments);
        $this->setTemplate('payment/grid.phtml')->setData(['payments' => $payments]);
        return $payments;
    }
    

    

  
}

?>