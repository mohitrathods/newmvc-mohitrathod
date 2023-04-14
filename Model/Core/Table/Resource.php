<?php

// require_once 'Model/Core/Request.php';
class Model_Core_Table_Resource extends Model_Core_Request{
    
    //table name > example product, primary key of table, model
    protected $resourceName = null;
    protected $primaryKey = null;

    protected $adapter = null;


    function __construct()
	{
		
	} 

    //------------------- set & get primarykey
    

    public function setPrimaryKey($primaryKey){
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getPrimaryKey(){
        return $this->primaryKey;
    }

    
    //------------------- set & get ResourceName
    public function setResourceName($ResourceName){
        $this->resourceName = $ResourceName;
        return $this;
    }

    public function getResourceName(){
        return $this->resourceName;
    }

    //------------------- set & get adapter

    public function setAdapter($parameter){
        $this->adapter = $parameter;
        return $this;
    }

    public function getAdapter(){
        //access to adapter class
        if($this->adapter){
            return $this->adapter;
        }
        $adapter = new Adapter();
        $this->setAdapter($adapter);
        return $adapter; 

    }


    //------------------------------------------------------------

    public function fetchAll($query){
        return $this->getAdapter()->fetchAll($query); //return this result
        
    }

    public function insert($data){
        $keys = array_keys($data);
        $values = array_values($data);

        $keyString = "`".implode('`,`',$keys)."`";
        $valueString = "'".implode("','",$values)."'";

        $query = "INSERT INTO `{$this->getResourceName()}` ({$keyString}) VALUES ({$valueString})";
        print_r($query);
        return $this->getAdapter()->insert($query);

    }

    public function fetchRow($query){
        return $this->getAdapter()->fetchRow($query);
    }

    public function update($data,$condition){

        foreach ($data as $key => $value) {
            $keys[] = "`$key` = '$value'";
        }
        
        $testString = implode(',',$keys);

        if(is_array($condition)){
            foreach($condition as $key => $value){
                $conditionString[] = "`$key` = '$value'";
            }
            $implode = implode('AND',$conditionString);
            $query = "UPDATE `{$this->resourceName}` SET $testString WHERE $implode";
        }
        else{
            $query = "UPDATE `{$this->resourceName}` SET $testString WHERE $condition";
        }

        print_r($query);

        return $this->getAdapter()->update($query);
    }
    
    public function delete($deleteId){
        $query = "DELETE FROM `{$this->resourceName}` WHERE `{$this->primaryKey}` = '{$deleteId}'";
        return $this->getAdapter()->delete($query);
    }

    public function load($value, $column = null)
	{
		$column = (!$column) ? $this->getPrimaryKey() : $column;
		$query = "SELECT * FROM `{$this->resourceName}` WHERE `{$column}` = $value";
		$row = $this->getAdapter()->fetchRow($query);
		return $row;	
	}

}
?>