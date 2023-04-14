<?php
require_once 'Controller/Core/Action.php';

class Controller_Admin extends Contoller_Core_Action{
    public function gridAction() {
        Ccc::getModel('Core_Session')->start();

        try {
            $grid = new Block_Admin_Grid();
            $this->getLayout()->getChild('content')->addChild('grid', $grid);
            $grid->getCollection();
            $this->getLayout()->render();
        } 
        catch (Exception $e) {
            
        }
    }

    public function addAction(){
        Ccc::getModel('Core_Session')->start();

        $add = new Block_Admin_Edit();
        $this->getLayout()->getChild('content')->addChild('add', $add);
        $add->getCollection();
        // print_r($this->getLayout());
        $this->getLayout()->render();
    }

    public function editAction(){
        Ccc::getModel('Core_Session')->start();
        $id = $this->getRequest()->getParam('id');

        try {
            if(!$id){
                throw new Exception("id not found",1);
            }

            $edit = new Block_Admin_Edit();
            $this->getLayout()->getChild('content')->addChild('edit', $edit);
            $edit->getCollection();
            $this->getLayout()->render();
        }
        catch(Exception $e){
            Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
        }

    }

    public function saveAction(){
        Ccc::getModel('Core_Session')->start();
        $id = $this->getRequest()->getParam('id');

        if(!$id){
            $addAdmin = $this->getRequest()->getPost('admin');

            try {
                if(!$addAdmin){
                    throw new Exception("admin data not found",1);
                }
                else {
                    $row = Ccc::getModel('Admin')->setData($addAdmin);
                    date_default_timezone_set("Asia/Kolkata");
                    $datetime = date("Y:m:d h:i:sA");
                    $row->created_at = $datetime;
                    $row->save();

                    Ccc::getModel('Core_Message')->addMessages("admin row inserted succesffully", Model_Core_Message::SUCCESS);
                }
            } 
            catch (Exception $e) {
                Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
            }
            
        }

        else {
            $updateAdmin = $this->getRequest()->getPost('admin');

            try {
                if(!$updateAdmin){
                    throw new Exception("admin data not found",1);
                }
                else{
                    $row = Ccc::getModel('Admin')->setData($updateAdmin);
                    date_default_timezone_set("Asia/Kolkata");
                    $datetime = date("Y:m:d h:i:sA");
                    $row->updated_at = $datetime;
                    $row->admin_id = $id;
                    $row->save();

                    Ccc::getModel('Core_Message')->addMessages("data updated successfully", Model_Core_Message::SUCCESS);
                }
            } 
            catch (Exception $e) {
                Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
            }
            
        }

        $this->redirect('admin', 'grid',[],true);

    }

    
    public function deleteAction(){
        Ccc::getModel('Core_Session')->start();
        $deleteId = $this->getRequest()->getParam('id');

        try {
            if(!$deleteId){
                throw new Exception("delete id not found : data not deleted",1);
            }
            else{
                Ccc::getModel('Admin')->load($deleteId)->delete();
                Ccc::getModel('Core_Message')->addMessages("data deleted successfully", Model_Core_Message::SUCCESS);
            }

        } 
        catch (Exception $e) {
            Ccc::getModel('Core_Message')->addMessages($e->getMessage() , Model_Core_Message::FAILURE);
        }

        
        $this->redirect('admin', 'grid', [], true);
    }
}