<?php

namespace App\Controllers;

use Exception;

class ImageController {


    private $name;
    private $image = [];

    public function __construct($image)
    {
        $this->image = $image;
    }


    public function treatImage($name){


        $mimeType =  explode("/", $this->image["type"]); 

        $fileType = $mimeType[0];
        $fileExtension = $mimeType[1]; 
        
        if($fileType !== "image"){
            throw new Exception("file Type must be an Image"); 
            return; 
        }

        $this->name = $name . "." . $fileExtension; 

        return $this->name; 

    }
    public function uploadImage(){
        move_uploaded_file($this->image['tmp_name'], "storage/images/" . $this->name);
    }
    public function imageExists(){
        return file_exists("storage/images/" . $this->name);
    }


}