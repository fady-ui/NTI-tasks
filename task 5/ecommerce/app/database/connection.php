<?php

namespace app\database;

use mysqli;

class connection{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "nti ecommerce";

    protected $con;

    //run connection
    public function __construct()
    {
        $this->con = new mysqli($this->hostname, $this->username, $this->password, $this->database);

        //testing for connection
        // if($this->con->connect_error){
        //     die("failed".$this->con->connect_error);
        // }
        // echo "done";
    }

    //dml [insert, update, delete]
    public function runDML($query) :bool
    {
        $result = $this->con->query($query);
        if ($result) {
            return true;
        }else{
            return false;
        }
    }

    //dql [select]
    public function runDQL($query)
    {
      return $this->con->query($query);
    }

    //stop connection
    public function __destruct()
    {
        $this->con->close();
    }
}


