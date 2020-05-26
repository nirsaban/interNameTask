<?php
require 'config.php';

class DbConnection{

    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    protected function connect(){
        $con = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
        if (!$con) {
            echo 'Connection Error =>' . mysqli_connect_error();
        }
        return $con;
    }

}




?>