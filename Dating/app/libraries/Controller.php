<?php


class Controller {
    //load model
    public function model($model){
        //Require model file

        require_once '../app/models/' .$model . '.php';

        return new $model();
    }

    //load view 
    public function view($view, $data = []){
        
        if(file_exists('../app/views/' .$view . '.php')){
            require_once '../app/views/' .$view . '.php';
            
        }else{
           
            die('view doesn t exist!!' );
        }
    }

}