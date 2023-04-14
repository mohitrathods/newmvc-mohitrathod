<?php

require_once 'Controller/Core/Action.php';

class Controller_Item extends Contoller_Core_Action{

	public function gridAction(){
		Ccc::getModel('Core_Session')->start();
		// echo "inseide grid";
		$grid = new Block_Item_Grid();
		$this->getLayout()->getChild('content')->addChild('grid',$grid);
		$grid->getCollection();
		$this->getLayout()->render();
	}

	public function addAction(){
		Ccc::getModel('Core_Session')->start();

		$add = new Block_Item_Edit();
		$this->getLayout()->getChild('content')->addChild('add', $add);
		$add->getCollection();
		$this->getLayout()->render();
	}

	public function editAction(){
		Ccc::getModel('Core_Session')->start();
		$id = Ccc::getModel('Core_Request')->getParam('id');
		
		try {
            if(!$id){
                throw new Exception("id not found",1);
            }
			
			$edit = new Block_Item_Edit();
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
		$id = Ccc::getModel('Core_Request')->getParam('id');

		print_r($id);

		if(!$id){
			try{
				$getPost = Ccc::getModel('Core_Request')->getPost('item');

				if(!$getPost){
					throw new Exception("no data found",1);
				}

				else{
					$row = Ccc::getModel('Item')->setData($getPost);
					date_default_timezone_set('Asia/Kolkata');
					$datetime = date("y:m:d h:i:sA");
					$row->created_at = $datetime;
					$row->save();

					Ccc::getModel('Core_Message')->addMessages("data inserted successfully",Model_Core_Message::SUCCESS);
				}
			}
			catch(Exception $e) {
				Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
			}
		}

		else{
			try{
				$getPost = Ccc::getModel('Core_Request')->getPost('item');

				if(!$getPost){
					throw new Exception("no data found",1);
				}

				else{
					$row = Ccc::getModel('Item')->setData($getPost);
					date_default_timezone_set('Asia/Kolkata');
					$datetime = date("y:m:d h:i:sA");
					$row->updated_at = $datetime;
					$row->item_id = $id;
					$row->save();

					Ccc::getModel('Core_Message')->addMessages("data added successfully", Model_Core_Message::SUCCESS);
				}
			}
			catch(Exception $e){
				Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
			}
		}


        $this->redirect('item', 'grid',[],true);
	}

	public function deleteAction(){
		Ccc::getModel('Core_Session')->start();
		$id = Ccc::getModel('Core_Request')->getParam('id');

		try {
			if(!$id){
				throw new Exception("delete id not found",1);
			}

			Ccc::getModel('Item')->load($id)->delete();
			Ccc::getModel('Core_Message')->addMessages("data deletd successfully",Model_Core_Message::SUCCESS);
		} 
		catch (Exception $e) {
			Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
		}

        $this->redirect('item', 'grid', [], true);
	}


}

?>