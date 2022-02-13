<?php

    class HomeController extends Controller{
        public function __construct()
        {
           // echo "this is HomeController man";
        }

        public function index(){
            $data=[
                'users'=>[]
            ];
           $this->view('index',$data);
        }

        public function register(){
           
           $this->view('register');
        }

        public function forgotPassword(){
            $data=[];
            $this->view('forgot-password');
        }
        
        public function resetPassword($email=''){
            
            if(isset($_SESSION["encrypted_email"])){
                $dyc_email=decrypt_var($_SESSION["encrypted_email"]);
                 $email=decrypt_var($email);
                
                if($email!=$dyc_email || $email=='') redirect('.');
            }else redirect(".");
         
            $data=[
                "email"=>$dyc_email
            ];

             $this->view('reset-password', $data);
        }
        
        public function Activer($email=''){
            
            if(isset($_SESSION["encrypted_email"])){
                 $dyc_email=decrypt_var($_SESSION["encrypted_email"]);
                 $email=decrypt_var($email);
                
                if($email!=$dyc_email || $email=='') redirect('.');
            }else redirect(".");
         
            $data=[
                "email"=>$dyc_email
            ];

            $this->view('activer',$data);
        }
        

        public function error(){

            $this->view("extra/404");
        }
    }


?>