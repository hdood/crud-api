<?php

use App\Helper\Helper; 


$router = new AltoRouter(); 

$router->setBasePath("/api"); 



$router->map("post", "/products", function () { Helper::addProduct(); }); 
$router->map("post", "/products/delete", function () { echo Helper::deleteProduct(); }); 
$router->map("get", "/products", function(){ Helper::indexProduct();}); 
$router->map("post", '/products/update', function(){ Helper::updateProduct();});
$router->map("get", "/home", "test.html");


$match = $router->match(); 

if(is_array($match)){

    if(is_string($match['target'])){
        include $match['target']; 
    }
    if(is_callable( $match['target'])){
        call_user_func_array( $match['target'], $match['params'] ); 
    }

}else {
    echo "not found";
}