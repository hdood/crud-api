<?php

namespace App\Services; 


class Request {
    public $post;
    public $get;
    public $put; 
    public $delete;
    public $files; 

    public function __Construct(){
        global $_DELETE; 
        global $_PUT;
        $this->get = $_GET; 
        $this->post = $_POST;
        $this->files = $_FILES; 
        $this->delete = $_DELETE; 
        $this->put = $_PUT; 
    }



}