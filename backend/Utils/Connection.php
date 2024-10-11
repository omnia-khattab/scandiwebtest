<?php 

namespace Utils;

use mysqli;

class Connection {
    private $serverName,$dbName,$dbPassword,$dbUsername;

    public function connect(){
        $this->serverName='localhost';
        $this->dbUsername='root';
        $this->dbName='scandiweb';
        $this->dbPassword='';

        $connection = new mysqli($this->serverName, $this->dbUsername, $this->dbPassword, $this->dbName);
        // Check connection
        if($connection === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        return $connection;
    }
}


?>