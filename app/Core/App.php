<?php

    class App{

        //On dévise notre url ==> /controller/Methode/params
        protected $currentController='HomeController';
        protected $currentMethode='index';
        protected $params=[];

        public function  __construct()
        {
            $url=$this->getURL();
       
            require_once '../app/controllers/'.$this->currentController.'.php';
            $this->currentController=new $this->currentController;
       
            if(!empty($url)){
                        
                if($this->HomePages($url)){
                    call_user_func_array([$this->currentController,$this->currentMethode],$this->params);
                }else {

                    $url[0].='Controller';
                    
                    if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')) {
                        // If the controller exists, then load it
                        $this->currentController =ucwords($url[0]); 

                        //vider controller sur l url
                        unset($url[0]);
                        //On appel le controlleur
                        require_once '../app/controllers/'.$this->currentController.'.php';
                        $this->currentController=new $this->currentController;

                        //Récuperation du methode
                        if(isset($url[1])){
                            if(method_exists($this->currentController,$url[1])){
                                $this->currentMethode=$url[1];
                                unset($url[1]);
                            }else {
                                redirect('.');
                            }
                        }
                        
                        //Les parametres
                        $this->params=$url ? array_values($url):[];

                        //On appel notre méthode
                        call_user_func_array([$this->currentController,$this->currentMethode],$this->params);
                    
                        
                    }else {
                        
                        $this->currentMethode='error';
                        call_user_func_array([$this->currentController,$this->currentMethode],$this->params);
                
                    }
                }
                

            }else {
                call_user_func_array([$this->currentController,$this->currentMethode],$this->params);
            
            }

             
           
        }


        //Cette fonction permet de récupérer l'url 
        public function getURL(){
            if(isset($_GET['url'])){
                $url=rtrim($_GET['url'],'/');
                $url=filter_var($url,FILTER_SANITIZE_URL);
                $url=explode('/',$url);
                return $url;
            }
        }

        //Redirect les premiers Pages tels que login, register ...
        public function HomePages($url){
            
            switch($url[0]){
                case "register": $this->currentMethode="register";
                    break;
                case "forgotPassword": $this->currentMethode=$url[0];
                    break;
                case "resetPassword": $this->currentMethode=$url[0];
                    break;
                case "activer": $this->currentMethode=$url[0];
                break;
            
                default: return false;
           
            }

            unset($url[0]);

            //Les parametres
            
            $this->params=$url ? array_values($url):[];
                if(count($this->params)>=0){
                    return true;
                }
            
            return false;

            
        }
    }


?>