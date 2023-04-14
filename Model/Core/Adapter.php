<?php
class Adapter {
    public $config = [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'databasename' => 'project-mohit-rathod'
    ];

    public $connect = null;
    public function connect(){
        if ($this->connect = null) {
            return $this->connect;
        }
        //else
        $connect = mysqli_connect(
            $this->config['host'],
            $this->config['username'],
            $this->config['password'],
            $this->config['databasename']
        );
        return $connect;
    }

    //FETCH ALL
    public function fetchAll($query){
        $connect = $this->connect();
        $result = mysqli_query($connect, $query);


        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        // return $result;
        return false;
    }

    //INSESRT
    public function insert($query){
        $connect = $this->connect();
        $result = mysqli_query($connect, $query);

        if($result){
            return $connect->insert_id;
        }
        else {
            return false;
        }
    }

    //FETCHROW
    public function fetchRow($query){
        $connect = $this->connect();
        $result = mysqli_query($connect, $query);

        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        else {
            return false;
        }
    }

    //UPDATE 
    public function update($query){
        $connect = $this->connect();
        $result = mysqli_query($connect, $query);

        if($result){
            return true;
        }
        else {
            return false;
        }
    }

    public function delete($query){
        $connect = $this->connect();
        $result = mysqli_query($connect, $query);

        if($result){
            return true;
        }
        else {
            return false;
        }
    }
}
?>