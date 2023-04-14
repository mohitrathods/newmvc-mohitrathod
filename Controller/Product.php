<?php
require_once 'Controller/Core/Action.php';

class Controller_Product extends Contoller_Core_Action {

    public function gridAction() {
        Ccc::getModel('Core_Session')->start();

        try {
            $productGrid = new Block_Product_Grid();
            $this->getLayout()->getChild('content')->addChild('grid', $productGrid);
            $productGrid->getCollection();
            $this->getLayout()->render();
        } 
        catch (Exception $e) {
            
        }
    }

    public function addAction() {
        Ccc::getModel('Core_Session')->start();

        $productAdd = new Block_Product_Edit();
        $this->getLayout()->getChild('content')->addChild('add',$productAdd);
        $productAdd->getCollection();
        $this->getLayout()->render();
    }

    public function editAction() {
        Ccc::getModel('Core_Session')->start();
        $id = $this->getRequest()->getParam('id');

        try {
            if(!$id){
                throw new Exception("id not found",1);
            }

            $productEdit = new Block_Product_Edit();
            $this->getLayout()->getChild('content')->addChild('edit',$productEdit);
            $productEdit->getCollection();
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
            $addProduct = $this->getRequest()->getPost('product');

            try {
                if(!$addProduct){
                    throw new Exception("data not inserted",1);
                }

                else{
                    $row = Ccc::getModel('Product')->setData($addProduct);
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
            $updateProduct = $this->getRequest()->getPost('product');

            try {
                if(!$updateProduct){
                    throw new Exception("data not updated",1);
                }

                else{
                    $row = Ccc::getModel('Product')->setData($updateProduct);
                    date_default_timezone_set("Asia/Kolkata");
                    $datetime = date("Y:m:d h:i:sA");
                    $row->updated_at = $datetime;
                    $row->product_id = $id;
                    $row->save();

                    Ccc::getModel('Core_Message')->addMessages("data updated successfully", Model_Core_Message::SUCCESS);
                }
            } 
            catch (Exception $e) {
                Ccc::getModel('Core_Message')->addMessages($e->getMessage() ,Model_Core_Message::FAILURE);
            }
        }

        $this->redirect('product', 'grid',[],true);
    }

    public function deleteAction() {
        Ccc::getModel('Core_Session')->start();
        $deleteId = $this->getRequest()->getParam('id');

        try {
            if(!$deleteId){
                throw new Exception("delete id not found data not deletd",1);
            }
            else{
                Ccc::getModel('Product')->load($deleteId)->delete();
                Ccc::getModel('Core_Message')->addMessages("data deleted successfully",Model_Core_Message::SUCCESS);
            }
        } 
        catch (Exception $e) {
            Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
        }

        $this->redirect('product', 'grid',[],true);

    }
}
?>