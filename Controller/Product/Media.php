
<?php

require_once 'Controller/Core/Action.php';

class Controller_Product_Media extends Contoller_Core_Action {

    public function gridAction(){
        Ccc::getModel('Core_Session')->start();

        try {
            $grid = new Block_Product_Media_Grid();
            $this->getLayout()->getChild('content')->addChild('grid',$grid);
            $grid->getCollection();
            $this->getLayout()->render();
        } 
        catch (Exception $e) {
            
        }
    }
    

    public function addAction(){
        Ccc::getModel('Core_Session')->start();
        $productId = Ccc::getModel('Core_Request')->getParam('id');

        $add = new Block_Product_Media_Edit();
        $this->getLayout()->getChild('content')->addChild('add',$add);
        $add->getCollection();
        $this->getLayout()->render();
    }

    public function saveAction(){
        echo "<pre>";
        Ccc::getModel('Core_Session')->Start();
        $productId = Ccc::getModel('Core_Request')->getParam('id');
        $mediaPost = Ccc::getModel('Core_Request')->getPost('media');

            //insert id
            $mediaPost['product_id'] = $productId;
        
            // file name
            $imagename = $_FILES['media']['name']['image'];
            $mediaPost['image'] = $imagename;
            print_r($mediaPost);

            $add = new Block_Product_Media_Edit();
            $addaata = Ccc::getModel('Product_Media')->setData($mediaPost);
            $addaata->save();

            move_uploaded_file($_FILES['media']['tmp_name']['image'],"images/".$imagename);
    }

    public function deleteAction() {

    }
}

?>
