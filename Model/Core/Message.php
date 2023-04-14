<?php
require_once 'Model/Core/Session.php';


class Model_Core_Message{
    protected $session = null;

    const SUCCESS = 'success';
    const FAILURE = 'failure';
    const NOTICE = 'notice';

    //------------------- setter getter session
    public function setSession($session){
        $this->session = $session;
        return $this;
    }

    public function getSession(){
        if($this->session){
            return $this->session;
        }

        $session = new Model_Core_Session();
        $this->setSession($session);
        return $session;
    }

    //----------------------------
    public function addMessages($message, $type=null){
        //"data not found", 'failure'

        if (!$type) {
			$type = self::SUCCESS;
		}

        if($this->getSession()->has('message')){
            $this->getSession()->set('message',[]);
        }

        $messages = $this->getMessages();
        $messages[$type] = $message;
        // $messages['failure'] = 'data not found';

        $this->getSession()->set('message', $messages);
		return $this;
    }

    public function clearMessage(){
        // $_SESSION['message'] = [];
        // $this->getSession()->unset('message');
        //or
        $this->getSession()->unset('message');
    }


    public function getMessages(){
        if (!$this->getSession()->has('message')) {
			return null;
		}
		
        return $this->getSession()->get('message');
        //$_SESSION[$key] = 'message' > values = 'data not found' => 'failure'
    }
}
?>