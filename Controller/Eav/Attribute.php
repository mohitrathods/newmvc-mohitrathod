<?php
require_once 'Controller/Core/Action.php';

class Controller_Eav_Attribute extends Contoller_Core_Action {
    public function gridAction(){
        Ccc::getModel('Core_Session')->start();

        try {
            $attributeGrid = new Block_Eav_Attribute_Grid();
            $this->getLayout()->getChild('content')->addChild('grid',$attributeGrid);
            $this->getLayout()->render();

            $layout = $this->getLayout();
            //ccc::getmodel('eav_attribute');
            // $layout->createBlock('Eav_Attribute_Grid')->setData(['' => $x]); //make this change 
        } 
        catch (Exception $e) {
            
        }
    }  
    
    public function addAction() {
        Ccc::getModel('Core_Session')->start();

        $add = new Block_Eav_Attribute_Edit();
        $this->getLayout()->getChild('content')->addChild('add',$add);
        $add->getCollection();
        $this->getLayout()->render();
    }

    public function editAction(){
        Ccc::getModel('Core_Session')->start();
    
        $edit = new Block_Eav_Attribute_Edit();
        $this->getLayout()->getChild('content')->addChild('edit',$edit);
        $edit->getCollection();
        $this->getLayout()->render();
    }

    public function saveAction()
	{
		try {
			Ccc::getModel('Core_Session')->start();
			// if (!Ccc::getModel('Core_Request')->isPost()) {
			// 	throw new Exception("Invalid request.", 1);
			// }

			$postData = Ccc::getModel('Core_Request')->getPost();
			if (!$postData) {
				throw new Exception("No data found.", 1);
			}
            $abc = $postData['attribute'];

            $attributeId = Ccc::getModel('Core_Request')->getParam('id');
            print_r($attributeId);

			if ($attributeId) {
                echo 111;
				$attribute = Ccc::getModel('Eav_Attribute')->load($attributeId);
				if (!$attribute) {
					throw new Exception("Attribute data not added.", 1);
				}
                $abc['attribute_id']=$attribute->attribute_id;
	 		} 
            else {
	 			$attribute = Ccc::getModel('Eav_Attribute');
			}

			$attribute->setData($abc);
			if (!$attribute->save()) {
				throw new Exception("Attribute data not saved.", 1);
			} 
            else {
				$attributeId = $attribute->attribute_id;
				if (array_key_exists('exist', $postData['option'])) {
					$query = "SELECT * FROM `eav_attribute_option` WHERE `attribute_id` = {$attributeId}";
					$attributeOptionModel = Ccc::getModel('Eav_Attribute_Option');
					$attributeOption = $attributeOptionModel->fetchAll($query);
					if ($attributeOption) {
						foreach ($attributeOption->getData() as $row) {
							if (!array_key_exists($row->option_id, $postData['option']['exist'])) {
								$row->setData(['option_id' => $row->option_id]);
								if (!$row->delete()) {
									throw new Exception("data not deleted.", 1);
								}
							}
						}
					}
				}
				if (array_key_exists('new', $postData['option'])) {
					foreach ($postData['option']['new'] as $optionData) {
						$option['name'] = $optionData;
						$option['attribute_id'] = $attributeId;
						$attributeOption = Ccc::getModel('Eav_Attribute_Option');
						$attributeOption->setData($option);
						$attributeOption->save();
						unset($option);
					}
				}

			}
			Ccc::getModel('Core_Message')->addMessages('Attribute data saved Successfully.');

		} catch (Exception $e) {
			Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
		}
		$this->redirect('eav_attribute', 'grid', [], true);
	}

	public function deleteAction()
	{
		try {
			Ccc::getModel('Core_Session')->start();
			$attributeId = Ccc::getModel('Core_Request')->getParam('id');
			if (!$attributeId) {
				throw new Exception("ID not found.", 1);
			}

			$attribute = Ccc::getModel('Eav_Attribute'); 
			$result = $attribute->load($attributeId)->delete();
			if (!$result) {
				throw new Exception("Attribute data not deleted successfully.", 1);
			}
			Ccc::getModel('Core_Message')->addMessages('Attribute data saved Successfully.');

		} catch (Exception $e) {
			Ccc::getModel('Core_Message')->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
		}
		$this->redirect('eav_attribute', 'grid', [], true);
	}
}
?>