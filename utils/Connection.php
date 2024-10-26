<?php 

namespace Utils;

use PDO;

class Connection {
    private $dsn,$dbPassword,$dbUsername;
    public PDO $pDO;
    public function __construct()
    {
        $this->dsn = 'mysql:dbname=scandiwebtest;host=localhost';
        $this->dbUsername='root';
        $this->dbPassword='';

        $this->pDO = new PDO($this->dsn,$this->dbUsername,$this->dbPassword,);
        
        $this->pDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);   
    }
}


