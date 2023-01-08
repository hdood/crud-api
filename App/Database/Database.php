<?php

namespace App\Database;

use PDO;
use PDOException;

class Database {

    private $dsn = "mysql:host=localhost;dbname=id19013158_daw;charset=UTF8"; 
    private $user = "id19013158_mahdi";
    private $pwd = "Bouguerzi-123"; 
    private $conn; 

    public function __Construct()
    {  
        try{
            $conn = new PDO($this->dsn, $this->user, $this->pwd); 
        }catch(PDOException $e){
            echo $e->getMessage(); 
        }
        $this->conn = $conn;
    }
    public function connect(){
        return $this->conn; 
    }
}