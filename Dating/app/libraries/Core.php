<?php

/*
* URL FORMAT - /controller/method/params 
*/


class Core {
     
    protected $currentController = 'Pages';
    protected $currentMethode = 'index';
    protected $params = [];
   


    public function  __construct(){
    
    
    $url = $this->getUrl();
    
      
     if (isset($url[0])){
        
       if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
           

        $this->currentController = ucwords($url[0]);

        
        
        unset($url[0]);
        
       }
       
     }
     

     require_once '../app/controllers/'. $this->currentController . '.php';

     $this->currentController = new $this->currentController;



     // Seconde Part Of URL //

     if (isset($url[1])){
         if(method_exists($this->currentController, $url[1])){

            $this->currentMethode = $url[1]; 
            
            unset($url[1]);
         }

     }
    
    
    //  $this->params = $url ? array_values($url) : [];

    if ($url){
        $this->params = $url;
        // print_r($this->params);
    }else {
        $this->params =[];
        
        
    }


    // print_r($this->currentController);
    call_user_func_array([$this->currentController, $this->currentMethode], $this->params);
    

    }
    


    public function getUrl(){

        if (isset($_GET['url'])){
            
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            // $url = rawurlencode($_GET['url']);
            
            // echo $url;
            return $url;
            
       
         }

    }



}