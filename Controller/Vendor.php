<?php
require_once 'Controller/Core/Action.php';
class Controller_Vendor extends Contoller_Core_Action {

    public function gridAction() {
        Ccc::getModel('Core_Session')->start();

        try {
            $grid = new Block_Vendor_Grid();
            $this->getLayout()->getChild('content')->addChild('grid', $grid);
            $grid->getCollection();
            $this->getLayout()->render();
            
        } 
        catch (Exception $e) {
            
        }
    }

    public function addAction(){
        Ccc::getModel('Core_Session')->start();

        $add = new Block_Vendor_Edit();
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

            $edit = new Block_Vendor_Edit();
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
        
        if(!$id){
            $addVendor = Ccc::getModel('Core_Request')->getPost('vendor');
            $addAddress = Ccc::getModel('Core_Request')->getPost('address');

            try {
                if(!$addVendor){
                    throw new Exception("vendor data not inserted",1);
                }
                else {
                    $row = Ccc::getModel('Vendor')->setData($addVendor);
                    date_default_timezone_set("Asia/Kolkata");
                    $datetime = date("Y:m:d h:i:sA");
                    $row->created_at = $datetime;
                    $row->save();

                    $rowAddress = Ccc::getModel('Vendor_Address')->setData($addAddress);
                    // $rowAddress->vendor_id = $id;
                    // $rowAddress->save();

                    Ccc::getModel('Core_Message')->addMessages("data inserted successfully",Model_Core_Message::SUCCESS);
                }
            } 
            catch (Exception $e) {
                Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
            }

            
        }


        //else    ------------

        else {
            $updateVendor = Ccc::getModel('Core_Request')->getPost('vendor');
            $updateAddress = Ccc::getModel('Core_Request')->getPost('address');

            try {
                if(!$updateVendor){
                    throw new Exception("vendor data not updated",1);
                }

                else {
                    $rowAddress = Ccc::getModel('Vendor')->setData($updateAddress);
                    date_default_timezone_set('Asia/Kolkata');
                    $datetime = date("Y:m:d h:i:sA");
                    $rowAddress->updated_at = $datetime;
                    $rowAddress->save();

                    Ccc::getModel('Core_Message')->addMessages("data updated successfully", Model_Core_Message::SUCCESS);
                }
            } 
            catch (Exception $e) {
                Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
            }

            //-------- vendor address edit

            try {
                if(!$updateAddress){
                    throw new Exception("vendor data not updated",1);
                }

                else {
                    print_r($updateAddress);
                    print_r($id);
                    $row = Ccc::getModel('Vendor_Address')->setData($updateAddress);
                    date_default_timezone_set('Asia/Kolkata');
                    $datetime = date("Y:m:d h:i:sA");
                    $row->vendor_id = $id;
                    $row->save();

                    Ccc::getModel('Core_Message')->addMessages("data updated successfully", Model_Core_Message::SUCCESS);
                }
            } 
            catch (Exception $e) {
                Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
            }


        }
        $this->redirect('vendor', 'grid', [], true);

    }

    public function deleteAction() {
        Ccc::getModel('Core_Session')->start();
        $deleteId = Ccc::getModel('Core_Request')->getParam('id');
        
        try {
            if(!$deleteId){
                throw new Exception("data not deleted",1);
            }
            else {
                Ccc::getModel('Vendor')->load($deleteId)->delete();
                Ccc::getModel('Core_Message')->addMessages("data deleted successfully", Model_Core_Message::SUCCESS);
            }
        } 
        catch (Exception $e) {
            Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
        }

        $this->redirect('vendor', 'grid', [], true);

    }
}

?>