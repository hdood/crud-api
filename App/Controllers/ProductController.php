<?php

namespace App\Controllers;

use App\Services\Request; 
use App\Models\Product;
use App\Controllers\ImageController;
use PDOException;

class ProductController {


    public function index(){

        return (new Product())->all(); 

    }
    public function create(Request $request){
        $product = new Product(); 
        $imageController = new ImageController($request->files['image']); 
        $res = $product->create(
            $request->post['name'], 
            $request->post['price'], 
            $request->post['quantity'], 
            $imageController->treatImage($request->post["name"])
        ); 
        if(!$res){
            throw new PDOException("Product creation  failed"); 
            return;
        }
        $imageController->uploadImage(); 
        echo "product added"; 
    }
    public function delete(Request $request){
        $product = new Product(); 
        $res = $product->delete($request->post['id']);

        if($res){
            echo "product deleted succcefully"; 
        }
    }
    public function update(Request $request){
        $product = new Product(); 
        $imageController = new ImageController($request->files['image']); 
        $res = $product->update(
            $request->post['id'],
            $request->post['name'], 
            $request->post['price'], 
            $request->post['quantity'], 
            $imageController->treatImage($request->post["name"])
        ); 
        if(!$res){
            throw new PDOException("failed to update product"); 
            return;
        }
        if(!$imageController->imageExists()){
            $imageController->uploadImage(); 
        }
        echo "product updated succefully" ;
        
    }

}