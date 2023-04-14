<?php

require_once 'Controller/Core/Action.php';

class Controller_Admin extends Contoller_Core_Action{

	public function gridAction()
	{
		try {
			$grid = $this->getLayout()->createBlock('Category_Grid');
			$this->getLayout()->getChild('content')->addChild('grid',$grid);
			$this->getLayout()->render();

		} catch (Exception $e) {
			Ccc::getModel('Core_View')->getMessage()->add($e->getMessage(),Model_Core_Message::FAILURE);
			$this->redirect('grid');			
		}		
	}

	public function addAction()
	{
		try {
			$category = Ccc::getModel('Category');
			$edit = $this->getLayout()->createBlock('Category_Edit')->setData(['category'=>$category]);
			$this->getLayout()->getChild('content')->addChild('edit',$edit);
			$this->getLayout()->render();

		} catch (Exception $e) {
			Ccc::getModel('Core_View')->getMessage()->add($e->getMessage(),Model_Core_Message::FAILURE);
			$this->redirect('grid');
		}
	}

	public function editAction()
	{
		try {
			$categoryId = (int) Ccc::getModel('Core_Request')->getParam('category_id');
			if (!$categoryId) {
				throw new Exception("Invalid ID", 1);
			}

			$category = Ccc::getModel('Category')->load($categoryId);
			if (!$category) {
				throw new Exception("Invalid Request", 1);
			}

			$edit = $this->getLayout()->createBlock('Category_Edit')->setData(['category'=>$category]);
			$this->getLayout()->getChild('content')->addChild('edit',$edit);
			$this->getLayout()->render();

		} catch (Exception $e) {
			Ccc::getModel('Core_View')->getMessage()->add($e->getMessage(),Model_Core_Message::FAILURE);
			$this->redirect('grid','',[],true);
		}
	}

	public function saveAction()
	{
		try {
			if (!$this->getRequest()->isPost()) {
				throw new Exception("Data Not Posted", 1);
			}

			$postData = $this->getRequest()->getPost('category');
			if (!$postData) {
				throw new Exception("Data Not Posted", 1);
			}

			$categoryId = (int) $this->getRequest()->getParam('category_id');
			if ($categoryId) {
				$category = Ccc::getModel('Category')->load($categoryId);
				if (!$category) {
					throw new Exception("Invalid ID Request", 1);
				}
				$category->updated_at = date("y-m-d h:i:sA");
			}
			else{
				$category = Ccc::getModel('Category');
				$category->created_at = date("y-m-d h:i:sA");
			}

			$category->setData($postData);

			if (!$category->save()) {
				throw new Exception("Category Not Added", 1);
			}
			else{
				$category->updatePath();
				Ccc::getModel('Core_View')->getMessage()->add('Category has been saved successfully',Model_Core_Message::SUCCESS);
			}
			
		} 
		catch (Exception $e) {
			Ccc::getModel('Core_View')->getMessage()->add($e->getMessage(),Model_Core_Message::FAILURE);
		}

		$this->redirect('grid','',[],true);

	}

	public function deleteAction()
	{
		try {
			$categoryId = (int) $this->getRequest()->getParam('category_id');
			if (!$categoryId) {
				throw new Exception("Invalid ID", 1);
			}

			$category = Ccc::getModel('Category')->load($categoryId);
			if (!$category) {
				throw new Exception("Invalid Request", 1);
			}
			$query = "DELETE FROM `category` WHERE `path` LIKE '{$category->path}=%' OR `path` = '{$category->path}'";
			if (!$category->getResource()->getAdapter()->delete($query)) {
				throw new Exception("Error Processing Request", 1);
			}	
			else{
				Ccc::getModel('Core_View')->getMessage()->add('Category has been Deleted Successfully', Model_Core_Message::SUCCESS);
			}	

		} catch (Exception $e) {
			Ccc::getModel('Core_View')->getMessage()->add('Category Not Deleted',Model_Core_Message::FAILURE);
		}

		$this->redirect('grid','',[],true);
	}


}

?>