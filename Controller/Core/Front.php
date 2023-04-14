<?php

// require_once 'Model/Core/Request.php';

class Contoller_Core_Front{
    
    public function init(){
        $request = new Model_Core_Request();
        $controllerName = $request->getControllerName();
        
        $controllerClassName = 'Controller_'.ucwords($controllerName,'_'); //Controller_ Product_ 
        

        // if($controllerName = 'product_media'){
            $controllerPathName = str_replace("_","/",$controllerClassName).".php";
        // }
        // else {
        //     $controllerPathName = 'Controller/'.ucfirst($controllerName).'.php'; //Controller/Product.php
        // }

        
        require_once $controllerPathName; //Controller/Product.php


        $resultClassName = new $controllerClassName();
        
        $actionPath = $request->getActionName().'Action'; // grid.Action > gridAction
        $resultClassName->$actionPath();



    }
}
?>