<?php


class Block_Admin_Grid extends Block_Core_Abstracts {
    public function __construct(){ //call parent in all class
        parent::__construct();

        // $this->setTemplate('admin/grid.phtml');

	}

    public function getCollection(){
        $query = "SELECT * FROM `admin`";
        $admins = Ccc::getModel('Admin')->fetchAll($query);
        $this->setTemplate('admin/grid.phtml')->setData(['admins' => $admins]);
        // print_r($admins);
        return $admins;

    }
    

    

  
}

?>