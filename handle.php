<?php 

use App\Database\Database;

/*--------------------------------------------------------
|   parse DELETE and PUT request from php//:input
|----------------------------------------------------------
|  get key value pairs from php://input 
|  and parse them into global vars depending
|  on the request method
|
*/
parse_str(file_get_contents("php://input"), $params); 
        
if($_SERVER['REQUEST_METHOD'] === "DELETE"){

    $_DELETE = []; 
    foreach($params as $param => $value){
        $_DELETE[$param] = $value; 
    }
    
}
else {
    $_DELETE = []; 
}


if($_SERVER['REQUEST_METHOD'] === "PUT"){

    $_PUT = []; 
    foreach($params as $param => $value){
        $_PUT[$param] = $value; 
    }
}else {
    $_PUT = []; 
}

/*--------------------------------------------------------
|   Establish connection with database
|----------------------------------------------------------
|   Connect to tha database
|
*/

$connection = (new Database)->connect();