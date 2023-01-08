<?php 


namespace App\Helper; 

use App\Controllers\ProductController;
use App\Services\Request; 


class Helper {

    public static function addProduct(){
        $controller = new ProductController();
        $controller->create(new Request()); 
    }
    public static function indexProduct(){
        $controller = new ProductController(); 
        $controller->index(); 
    }
    public static function deleteProduct(){
        $controller = new ProductController(); 
        $controller->delete(new Request());        
    }
    public static function updateProduct(){
        $controller = new ProductController(); 
        $controller->update(new Request());  
    }

}