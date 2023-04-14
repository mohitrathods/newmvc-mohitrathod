<?php

require_once 'Controller/Core/Action.php';

class Controller_Payment extends Contoller_Core_Action{

    public function gridAction() {
        Ccc::getModel('Core_Session')->start();

        try {
            $grid = new Block_Payment_Grid();
            $this->getLayout()->getChild('content')->addChild('grid', $grid);
            $grid->getCollection();
            $this->getLayout()->render();
        }
        catch (Exception $e) {
        }

    }    

    public function addAction(){
        Ccc::getModel('Core_Session')->start();

        $add =  new Block_Payment_Edit();
        $this->getLayout()->getChild('content')->addChild('add',$add);
        $add->getCollection();
        $this->getLayout()->render();
    }

    public function editAction(){
        Ccc::getModel('Core_Session')->start();
        $id = $this->getRequest()->getParam('id');

        try {
            if(!$id){
                throw new Exception("id not found",1);  
            }

            $edit = new Block_Payment_Edit();
            $this->getLayout()->getChild('content')->addChild('edit',$edit);
            $edit->getCollection();
            $this->getLayout()->render();
        } 
        catch (Exception $e) {
            Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
        }

    }

    public function saveAction(){
        Ccc::getModel('Core_Session')->start();
        $id = $this->getRequest()->getParam('id');

        if(!$id){
            //add
            $addPayment = $this->getRequest()->getPost('payment');

            try {
                if(!$addPayment){
                    throw new Exception("data not inserted",1);
                }

                else{
                    $row = Ccc::getModel('Payment')->setData($addPayment);
                    date_default_timezone_set("Asia/Kolkata");
                    $datetime = date("Y:m:d h:i:sA");
                    $row->created_at = $datetime;
                    $row->save();                    
                    Ccc::getModel('Core_Message')->addMessages("data inserted successfully",Model_Core_Message::SUCCESS);
                }
            } 
            catch (Exception $e) {
                Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
            }
        }
        else{
            //update
            $updatePayment = $this->getRequest()->getPost('payment');

            try {
                if(!$updatePayment){
                    throw new Exception("data not updated",1);
                }

                else{
                    $row = Ccc::getModel('Payment')->setData($updatePayment);
                    date_default_timezone_set("Asia/Kolkata");
                    $datetime = date("Y:m:d h:i:sA");
                    $row->updated_at = $datetime;
                    $row->payment_method_id = $id;
                    $row->save();

                    Ccc::getModel('Core_Message')->addMessages("data updated successfully", Model_Core_Message::SUCCESS);
                }
            } 
            catch (Exception $e) {
                Ccc::getModel('Core_Message')->addMessages($e->getMessage() ,Model_Core_Message::FAILURE);
            }
        }

        $this->redirect('payment', 'grid',[],true);
    }

    public function deleteAction() {
        Ccc::getModel('Core_Session')->start();
        $deleteId = $this->getRequest()->getParam('id');

        try {
            if(!$deleteId){
                throw new Exception("data not deleted",1);
            }
            else{
                Ccc::getModel('Payment')->load($deleteId)->delete();
                Ccc::getModel('Core_Message')->addMessages("data deleted successfully",Model_Core_Message::SUCCESS);
            }
        } 
        catch (Exception $e) {
            Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
        }

        $this->redirect('payment', 'grid',[],true);
    }

}

?>
