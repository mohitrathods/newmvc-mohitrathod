<?php
require_once 'Controller/Core/Action.php';
class Controller_Customer extends Contoller_Core_Action {

    public function gridAction() {
        Ccc::getModel('Core_Session')->start();

        echo "<pre>";
        $data = Ccc::getModel('Customer')->getAddresses();
        print_r($data);

        echo "<br>";
        $getbilling = Ccc::getModel('Customer')->getBillingAddress();
        print_r($getbilling);

        echo "<br>";
        $getshipping = Ccc::getModel('Customer')->getShippingAddress();
        print_r($getshipping);
        die;

        try {
            $grid = new Block_Customer_Grid();
            $this->getLayout()->getChild('content')->addChild('grid', $grid);
            $grid->getCollection();
            $this->getLayout()->render();
            
        } 
        catch (Exception $e) {
            
        }
    }

    public function addAction(){
        Ccc::getModel('Core_Session')->start();

        $add = new Block_Customer_Edit();
        $this->getLayout()->getChild('content')->addChild('add', $add);
        $add->getCollection();
        $this->getLayout()->render();
    }

    public function editAction() {
        Ccc::getModel('Core_Session')->start();
        $id = Ccc::getModel('Core_Request')->getParam('id');

        try {
            if(!$id){
                throw new Exception("id not found",1);
            }

            $edit = new Block_Customer_Edit();
            $this->getLayout()->getChild('content')->addChild('edit', $edit);
            $edit->getCollection();
            $this->getLayout()->render();
        } 
        catch (Exception $e) {
            Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
        }
    }

    public function saveAction(){
        Ccc::getModel('Core_Session')->start();
        $id = Ccc::getModel('Core_Request')->getParam('id');
        print_r($id);
        
        if(!$id){
            $addCustomer = Ccc::getModel('Core_Request')->getPost('customer');
            $addAddress = Ccc::getModel('Core_Request')->getPost('address');

            try {
                if(!$addCustomer){
                    throw new Exception("customer data not inserted",1);
                }
                else {
                    $row = Ccc::getModel('Customer')->setData($addCustomer);
                    date_default_timezone_set("Asia/Kolkata");
                    $datetime = date("Y:m:d h:i:sA");
                    $row->created_at = $datetime;
                    $insertedData = $row->save();

                    $customerId = $insertedData->customer_id;
                    $rowAddress = Ccc::getModel('Customer_Address')->setData($addAddress);
                    $rowAddress->customer_id = $customerId;
                    $rowAddress->save();

                    Ccc::getModel('Core_Message')->addMessages("data inserted successfully",Model_Core_Message::SUCCESS);
                }
            } 
            catch (Exception $e) {
                Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
            }

            
        }


        //else    ------------

        else {
            $updateCustomer = Ccc::getModel('Core_Request')->getPost('customer');
            $updateAddress = Ccc::getModel('Core_Request')->getPost('address');

            try {
                if(!$updateCustomer){
                    throw new Exception("customer data not updated",1);
                }

                else {
                    $row = Ccc::getModel('Customer')->setData($updateCustomer);
                    date_default_timezone_set("Asia/Kolkata");
                    $datetime = date("Y:m:d h:i:sA");
                    $row->updated_at = $datetime;
                    $row->customer_id = $id;
                    $updateaData = $row->save();

                    $rowAddress = Ccc::getModel('Customer_Address')->setData($updateAddress);
                    $rowAddress->address_id = $id;
                    $rowAddress->save();
                    

                    Ccc::getModel('Core_Message')->addMessages("data updated successfully", Model_Core_Message::SUCCESS);
                }
            } 
            catch (Exception $e) {
                Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
            }
        }
           
        $this->redirect('customer', 'grid', [], true);

    }

    public function deleteAction() {
        Ccc::getModel('Core_Session')->start();
        $deleteId = Ccc::getModel('Core_Request')->getParam('id');
        
        try {
            if(!$deleteId){
                throw new Exception("data not deleted",1);
            }
            else {
                Ccc::getModel('Customer')->load($deleteId)->delete();
                Ccc::getModel('Core_Message')->addMessages("data deleted successfully", Model_Core_Message::SUCCESS);
            }
        } 
        catch (Exception $e) {
            Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
        }

        $this->redirect('customer', 'grid', [], true);

    }
}

?>