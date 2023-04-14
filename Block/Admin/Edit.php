<?php

class Block_Admin_Edit extends Block_Core_Abstracts {
    public function __construct(){
        parent::__construct();

        // $this->setTemplate('admin/edit.phtml');
    }

    public function getCollection() {
        $id = Ccc::getModel('Core_Request')->getParam('id');

        if(!$id){
            $adminRow = Ccc::getModel('Admin');
            $this->setTemplate('admin/edit.phtml')->setData(['admins' => $adminRow]);
        }

        else {
            $adminRow = Ccc::getModel('Admin')->load($id);
            $this->setTemplate('admin/edit.phtml')->setData(['admins' => $adminRow]);
        }
        return $adminRow;
    }
}

?>