<?php

require_once 'Model/Core/Adapter.php';
require_once 'Model/Core/Request.php';
require_once 'Model/Core/Message.php';

class Contoller_Core_Action{
    
    protected $request = null;
    protected $adapter = null;

    protected $urlObj = null;

    protected $message = null;

    protected $view = null;

    protected $layout = null;

    //----------- set get of layout
    public function setLayout($layout){
        $this->layout = $layout;
        return $this;
    }

    public function getLayout(){
        if($this->layout){
            return $this->layout;
        }

        $layout = new Block_Core_Layout();
        $this->layout = $layout;
        return $layout;
    }

    //----------- set get of view
    public function setView(Model_Core_View $view)
	{
		$this->view = $view;
		return $this;
	}

	public function getView()
	{
		if($this->view){
			return $this->view;
		}

		$view = new Model_Core_View();
		$this->setView($view);
		return $view;
	}

    //----------- set get of request

    public function setRequest($request){
        $this->request = $request;
        return $this;
    }

    public function getRequest(){
        if($this->request){
            return $this->request;
        }

        $request = new Model_Core_Request();
        $this->request = $request;
        return $request;
    }

    //----------- set get of adapter

    public function getAdapter(){
        if($this->adapter){
            return $this->adapter;
        }
        $adapter = new Adapter();
        $this->adapter = $adapter;
        return $adapter;
    }


    //-------------- setter getter of Url
    public function setUrlObj(Model_Core_Url $urlObj){
        $this->urlObj = $urlObj;
        return $this;
    }

    public function getUrlObj(){
        if($this->urlObj){
            return $this->urlObj;
        }
        $urlObj = new Model_Core_Url();
        $this->setUrlObj($urlObj);
        return $urlObj;
    }

    //------------------ setter getter of message
    public function setMessage($message){
        $this->message = $message;
        return $this;
    }

    public function getMessage(){
        if($this->message){
            return $this->message;
        }
        $message = new Model_Core_Message();
        $this->setMessage($message);
        return $message;
    }

    //-------------------------------------

    //redirect dynamic
    // public function redirect($url){
    //     header("location:{$url}");
    //     exit();
    // }

    public function redirect($controller = null, $action = null, $parameter = [], $reset = false){
        $url = $this->getUrlObj()->getUrl($controller, $action, $parameter, $reset);
        // print_r($url);
        header("location:{$url}");

        exit();
    }

    //require once > getTemplate or get Page
    public function getTemplate($templatePath){
        require_once 'View'.DS.$templatePath;
    }

    

}
?>