<?php 
class Block_Payment_Edit extends Block_Core_Abstracts{
    public function __construct(){
        parent::__construct();

    }

    public function getCollection() {
        $id = Ccc::getModel('Core_Request')->getParam('id');

        if(!$id){
            $paymentRow = Ccc::getModel('Payment');
            $this->setTemplate('payment/edit.phtml')->setData(['payments' => $paymentRow]);
        }

        else {
            $paymentRow = Ccc::getModel('Payment')->load($id);
            $this->setTemplate('payment/edit.phtml')->setData(['payments' => $paymentRow]);
        }

        return $paymentRow;
    }
}

?>