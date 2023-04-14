<?php
class Model_Customer extends Model_Core_Table{

    function __construct(){
        parent::__construct();
        $this->setResourceClass('Model_Customer_Resource');
        $this->setCollectionClass('Model_Customer_Collection');
    }

    public function getAddresses(){
        $query = "SELECT * FROM `customer`";
        $customers = $this->fetchRow($query);
        return $customers;
    }

//selected wether billing or shipping
//if  new address is along with selected billing or shipping from dropdown created, it will be new billing or shipping id as billing and shipping id have no primary keys

    public function getBillingAddress(){
        // echo "billing";
        // $primaryKey = Ccc::getModel('Customer_Address_Resource')->getPrimaryKey();
        // // print_r($primaryKey);
        // $query = "SELECT * FROM `customer` WHERE `{$this->getPrimaryKey()}` = `billing_{$primaryKey}`";
        // print_r($query);
        // $billingAddress = $this->fetchAll($query);
        // print_r($billingAddress);

        //select * from customer_address where address_id = billing_address_id

        // $query= "SELECT * FROM `customer` where `billing_address_id` = `1`";
        // $query = "SELECT `customer_address`.* FROM `customer_address` LEFT JOIN `customer` 
        // WHERE `customer_address.address_id` = `customer.billing_address_id`";
        // print_r($query);

        // $customerid = Ccc::getModel('Core_Request')->getParam('id');
        // $query = "SELECT * from `customer_address` WHERE $cus"
        //load id
        // $query = "SELECT * FROM `customer_address` WHERE `address_id` = 2"; //here 1 is dynamic
        $row = Ccc::getModel('Customer_Address')->load(2);
        print_r($row);


        //load row
        //load->getshippingaddr
        //->setdata


        // $res = $this->fetchAll($query);
        // $final = $this->fetchRow($query);
        // print_r($final);
    }

    public function getShippingAddress(){

    }

}
?>