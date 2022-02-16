<?php
     

    class UserController extends Controller{
       
        private $User;
        private $Pub;
        public function __construct()
        {
           
            $this->User=$this->model("Utilisateur");
            $this->Pub=$this->model("Publication");
  
        }

        public function index(){
           if(empty($_SESSION["id_user"])) redirect(".");
            $id=$_SESSION["id_user"];
            $suggests=$this->User->suggest($id);
            $ext=array('jpeg','jpg','png','gif');
            $statistique=$this->extraNombre($id);
            $mes_invs=$this->User->mesInvitations($_SESSION["id_user"]);
           
            
            $pubs=$this->Pub->NotMyPubs();
            $comments=$this->Pub->Commentaires();
            $user=$this->User->getUserId($id);
            $data=[
                "pubs"=>$pubs,
                "comments"=>$comments,
                "user"=>$user,
                "statistique"=>$statistique,
                "suggests"=>$suggests,
                "mes_invs"=>$mes_invs,
                "ext"=>$ext
           
            ];
             $this->view("Home",$data);
            
               
        }
      

        public function add(){
            $fullname=$_POST["fullname"];
            $email=$_POST["email"];
            $mdp=$_POST["mdp"];
            $rmdp=$_POST["rmdp"];
            $user=$this->User->getUser($email);
            if(empty($user)){
                if($mdp==$rmdp){
                    $mdp=crypt_var($mdp);
                    $check=$this->User->adduser($fullname,$email,$mdp);
    
                }else $check="ko";
                if( $check == "ok"){

                    $mail=setupemail();
                    $mail->Subject="activation of your account ";
                    $mail->setFrom(EMAIL_USERNAME);
                    
                    $mail->Body="Click the activation  link ".URLROOT."activer/".crypt_var($email);
                    $mail->addAddress($email);
                    if($mail->Send()){
                        $email=crypt_var($email);
                        $_SESSION["encrypted_email"]=$email;
                        $_SESSION["message"]=" Hello, your register is done, please click the activation link we sent to your email  !!!.";
                        redirect("./register");
                        $mail->smtpClose();
                    }

                }
                else{
                    $_SESSION["message_err"]=" Sorry , your password is not the same  !!!.";
                      redirect('./register');
                   
                }
            }else {
                
                $_SESSION["message_err"]=" Sorry, this mail is already exist !!!.";
                      redirect('./register');
            }
           
            
        }

        //Login
        public function login(){
            $email=$_POST["email"];
            $mdp=$_POST["mdp"];
            $user=$this->User->getUser($email);
            if(empty($user)){
                $_SESSION["message_err"]=" sorry , your email is incorrect !!!.";
                redirect(".");
            }
            else {
               
                if(!$user["active"]){
                    $_SESSION["message_err"]="You have to activate your account";
                    redirect(".");
                }else {
                    if(decrypt_var($user["mdp"])==$mdp){

                        $_SESSION["id_user"]=$user["id_utilisateur"];

                        if(empty($user["image_profil"])){
                            redirect("user/completinfo");
                        }
                        else redirect("user/");
                    }else {
                        $_SESSION["message_err"]=" Sorry, your password is incorrect !!!.";;
                        redirect(".");
                    } 
                }
                                  
            }
           
           
        }
        


        public function completinfo(){
            if(empty($_SESSION["id_user"])) redirect(".");
            $id=$_SESSION["id_user"];
            $statistique=$this->extraNombre($id);
            $mes_invs=$this->User->mesInvitations($_SESSION["id_user"]);
           
            $user=$this->User->getUserId($id);
            $data=[
                "user"=>$user,
                "statistique"=>$statistique,
                "mes_invs"=>$mes_invs,
            
            ];
            
            
            $this->view('completinfo',$data);
        }


        public function uploadData(){
            //Data 
            $id=$_SESSION["id_user"];
            $bio=$_POST["bio"];
            $education=$_POST["education"];
            $Location=$_POST["location"];
            $skills=$_POST["skills"];
            $notes=$_POST["notes"];
            $age=$_POST["age"];
            $gendre=$_POST["gender"];
            $images=$_FILES['profile']['name'];
            $tmp_dir=$_FILES['profile']['tmp_name'];
            $imageSize=$_FILES['profile']['size'];
            $upload_dir='uploads/users/';
            $imgEXT=strtolower(pathinfo($images,PATHINFO_EXTENSION));
            $valid_extensions=array('jpeg','jpg','png','gif','pdf');
            $picProfile=rand(1000,1000000).".".$imgEXT;
            
            if($this->User->update($bio,$education,$Location,$skills,$notes,$picProfile,$id,$age,$gendre)){
                move_uploaded_file($tmp_dir, $upload_dir.$picProfile);

                redirect("User/");
            }
            
        }


        public function profile($id_user=''){
            if(empty($_SESSION["id_user"])) redirect(".");
            if(empty($id_user))
               $id=$_SESSION["id_user"];
            
            else $id=decrypt_var($id_user);

            $user=$this->User->getUserId($id);
            if(count($user)==0) redirect("User/");
            $mesPubs=$this->Pub->mesPublications($id);
            $mes_invs=$this->User->mesInvitations($_SESSION["id_user"]);
             $statistique=$this->extraNombre($id);
            $comments=$this->Pub->Commentaires();
             $ext=array('jpeg','jpg','png','gif');
           
            
            $data=[
                'user'=>$user,
                'pubs'=>$mesPubs,
                "statistique"=>$statistique,
                "comments"=>$comments,
                "mes_invs"=>$mes_invs,
                "ext"=>$ext
            ];
            
            $this->view("profile",$data);

        }

     


        public function activerAccount(){

                $email=$_POST["email"];
                if($this->User->activeAccount($email)){
                    $_SESSION["message"]='Your account has been activated you may login ';
                    redirect(".");
                }

                            
        }

        //send mail to recuperer compte
        public function resetCompte(){
            $email=$_POST["email"];

            $user=$this->User->getUser($email);
            if(isset($user)){
                $email=crypt_var($email);
                $mail=setupemail();              
                //Set email subject
                 $mail->Subject = "Récupération compte";
                 //Set sender email
                $mail->setFrom(EMAIL_USERNAME);
                // Email body
                $mail->Body = "To reset your password click  ".URLROOT."resetPassword/".$email."";
            //Add recipient
                $mail->addAddress($user["email"]);
            //Finally send email
                if($mail->Send()){
                    $_SESSION["encrypted_email"]=$email;
                    $_SESSION["message"]='Check your email';
                    
                }
                
            //Closing smtp connection
                $mail->smtpClose();
            }else {
                $_SESSION["message_err"]='Incorrect email';
              
            }

            redirect("./forgotPassword");

            
        }
        
        //Changer le mot de passe
        public function updateMDP(){
            $email=$_POST["email"];
            $pwd=$_POST["pwd"];

            if($this->User->updatePwd($email,crypt_var($pwd))){
                $_SESSION["message"]='Your password has been changed, You may check your spam';
                redirect(".");
            }
           
            
        }

        public function extraNombre($id){
            $statistique=array(
                "friends"=>$this->User->getMyfriends($id),
                "invitations"=>count($this->User->mesInvitations($id)),
                "likes"=>$this->Pub->likesofUser($id)
            );
            return $statistique;
        }


        public function searchUser(){
            $q=$_POST["q"];
            $id=$_SESSION["id_user"];
            $users=$this->User->search($q,$id);
            if(empty($users)) echo "<h7>No result</h7>";
            else {
            foreach($users as $user){
                echo " <a class='media' style='margin-bottom: 5px;' href='".URLROOT."User/profile/".crypt_var($user["id_utilisateur"])."'>
                <img src='".URLROOT."uploads/users/".$user['image_profil']."' alt='User Avatar' class=' img-circle mr-3' width='40px'>
                <div class=(media-body(>
                <h3 class='dropdown-item-title'>
                    ".$user["fullname"]."
                </h3>
                </div>
                </a>
                <div class='dropdown-divider'></div>";
            }
            }
            
        }

        public function addFriend(){
            $id_e=$_SESSION["id_user"];
            $id_rec=$_POST["id_rec"];
            if($this->User->EnvoyerInvitation($id_e,$id_rec)) echo "yey";
        }

        public function makeDecision(){
            $id_inv=$_POST["id_inv"];
            $status=$_POST["status"];
            if($this->User->decision($id_inv,$status)){
                echo "yes";
            }
        }

        public function logout(){
            unset($_SESSION["id_user"]);
            if(empty($_SESSION["id_user"])) redirect(".");
        }
    }

   


?>