<?php

namespace App\Models;

use Exception;
use PDOException;

class Product {

    private $conn;

    public function __Construct()
    {
        global $connection;
        $this->conn = $connection;
    }

    public function all(){
        $result = []; 
        $query = "SELECT * FROM `product`";
        $statment = $this->conn->query($query); 
        while($row = $statment->fetchObject()){
            $result[] = $row; 
        }
        echo json_encode($result);
    }

    public function create(string $name, int $price, int $quantity, $img){
        $query = "INSERT INTO `product` (`name`, `price`, `quantity`, `image`) VALUES (?, ?, ?, ?)"; 
        $statment = $this->conn->prepare($query);
        return $statment->execute([$name, $price, $quantity, $img]);
    }

    public function delete(int $id){

        $selectQuery = 'SELECT `image` FROM `product` WHERE `id` = ?'; 
        $selectStatment = $this->conn->prepare($selectQuery); 
        $selectStatment->execute([$id]);
        $result = $selectStatment->fetchObject();  
        if(!$result){
            throw new Exception("product don't exist"); 
            return; 
        }
        $image = $result->image; 
        $deleteQuery = 'DELETE FROM `product` WHERE `id` = ?'; 
        $deleteStatment = $this->conn->prepare($deleteQuery);
        if(!$deleteStatment->execute([$id])){
            throw new PDOException("failed to delete product"); 
            return false; 
        }
        if(!unlink("storage/images/" . $image )) return false;  
        return true;

    }
    public function update(int $id,string $name, int $price, int $quantity, $image){
        $selectQuery = 'SELECT `image` FROM `product` WHERE `id` = ?'; 
        $selectStatment = $this->conn->prepare($selectQuery); 
        $selectStatment->execute([$id]);
        $result = $selectStatment->fetchObject();  
        if(!$result){
            throw new Exception("product don't exist"); 
            return; 
        }
        

        $updateQuery = 'UPDATE `product` SET `name` = ?, `price` = ?, `quantity` = ?, `image` = ? WHERE `id` = ?'; 
        $updateStatment = $this->conn->prepare($updateQuery);
        $res = $updateStatment->execute([
            $name,
            $price,
            $quantity, 
            $image, 
            $id
        ]);

        if(!$res){
            throw new Exception("failed to update product"); 
            return;
        }

        return true;
    }
    
}