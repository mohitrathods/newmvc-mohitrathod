<?php

class Block_Core_Abstracts extends Model_Core_View{
    // protected $children = ['on1' => 'one', 'tw2' => 'two'];
    protected $children = [];

    public function __construct(){
        parent::__construct();
	}
    
    public function setChildren(array $children){ //compulsory array type
        $this->children = $children;
        return $this;
    }

    public function getChildren(){
        return $this->children;
    }

    public function addChild($key, $value) {
        $this->children[$key] = $value;
    }

    public function getChild($key) {

        if(array_key_exists($key, $this->children)){
            return $this->children[$key];
        }
        
        return null;
    }

    public function removeChild($key) {
        if(array_key_exists($key , $this->children)){
            unset($this->children[$key]);
        }
        
        return $this;
    }
    
}

?>