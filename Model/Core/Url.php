<?php
require_once 'Model/Core/Request.php';
class Model_Core_Url{

    public function getUrl($controller = null, $action = null, $parameter = [], $reset = false){
        $request = new Model_Core_Request();
        $final = $request->getParam();
        // print_r($final);
        // print_r($final['c']);
        // print_r($request->getActionName());
        // echo "<pre>";

        if($reset){
            $final = [];
        }

        if($controller){ //if controller has some value then it will go inside
            $final['c'] = $controller;
        }

        else {
            $final['c'] = $request->getControllerName();
        }

        if($action){
            $final['a'] = $action;
        }

        else {
            $final['a'] = $request->getActionName();
        }

        if($parameter){
            $final = array_merge($final,$parameter);
        }

        $queryString = http_build_query($final); //each array key with &
      
        $requestUrl = trim($_SERVER['REQUEST_URI'], $_SERVER['QUERY_STRING']);

        $url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$requestUrl.$queryString;

        return $url;
    }
    

}

?>