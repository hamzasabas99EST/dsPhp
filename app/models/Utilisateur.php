<?php

    class Utilisateur{
        private $conn;

        public function __construct()
        {
            $this->conn=new Database();
           
        }

        public function getUsers(){
            $this->conn->query("SELECT * FROM utilisateur");
            return $this->conn->resultset();
        }

        public function getUserId($id=''){
            $this->conn->query("SELECT u.*,count(p.id_utilisateur) 'pubs' FROM utilisateur u JOIN publication p USING(id_utilisateur) WHERE id_utilisateur=:id");
            $this->conn->bind('id',$id);
            $user=$this->conn->single();
            if($this->conn->rowCount()==1){
                return $user;
            }
        }

        //Cette function permet de récupérer l'utilisateur par l'email ou bien par l'id
        public function getUser($email=''){
            $this->conn->query("SELECT * FROM utilisateur WHERE email=:email");
            $this->conn->bind('email',$email);
            $user=$this->conn->single();
            if($this->conn->rowCount()==1){
                return $user;
            }
        }

        public function search($fullname='',$id){
            $this->conn->query("SELECT id_utilisateur,image_profil,fullname,apropos FROM utilisateur WHERE fullname like :fullname AND id_utilisateur!=:id");
            $this->conn->bind('fullname','%'.$fullname.'%');
            $this->conn->bind('id',$id);
            $users=$this->conn->resultset();
            if($this->conn->rowCount()>=1){
                return $users;
            }
        }

          //register
          public function adduser($name,$email,$mdp)
          {
              try{
                  $this->conn->query("INSERT INTO utilisateur (fullname,email,mdp,active) VALUES (:fullname,:email,:pwd,:active) ");
                  $this->conn->bind("fullname",$name);
                  $this->conn->bind("email",$email);
                  $this->conn->bind("pwd",$mdp);
                  $this->conn->bind("active",0);
                  
                  $this->conn->execute();
                  if($this->conn->rowCount()==1){
                      return "ok";
                  }else return "ko";
  
              }catch(Exception $e){
                 echo $e->getMessage();
              }
          }

        //Modifiier le mot de passe 
        public function updatePwd($email,$pwd){
            $this->conn->query("UPDATE utilisateur SET mdp=:mdp WHERE email=:email");
            $this->conn->bind('mdp',$pwd);
            $this->conn->bind('email',$email);
            if($this->conn->execute()){
                return true;
            }
            return false;
        } 

         //Modifiier le mot de passe 
         public function activeAccount($email){
            $this->conn->query("UPDATE utilisateur SET active=1 WHERE email=:email");
            $this->conn->bind('email',$email);
            if($this->conn->execute()){
                return true;
            }
            return false;
        } 

        //Cette function permet d'afficher des propositions pour ajouter amis
       //Cette function permet d'afficher des propositions pour ajouter amis
        public function suggest($id){
            $this->conn->query("
            SELECT * from utilisateur 
            WHERE id_utilisateur!=:id 
            AND  ( id_utilisateur NOT IN( SELECT id_emetteur from invitation) 
                 OR id_utilisateur NOT IN ( SELECT id_recepteur from invitation) 
                 )
            ");
            $this->conn->bind("id",$id);
            $users=$this->conn->resultset();
            if($this->conn->rowCount()>=0){
                return $users;
            }
        }



        //Cette fonction permet de récuprér les amis d'utilisateur
        public function getMyfriends($id){
            $this->conn->query("SELECT * FROM invitation WHERE status=1 AND (id_recepteur=:idR OR id_emetteur=:idE)");
            $this->conn->bind("idR",$id);
            $this->conn->bind("idE",$id);
           $this->conn->execute();
            if($this->conn->rowCount()>=0){
                    return $this->conn->rowCount();
            }
        }

        //Cette fonction permet d'afficher les invitations d'utilisateur
        public function mesInvitations($id){
            $this->conn->query("SELECT e.*,i.* FROM invitation i JOIN utilisateur e ON(e.id_utilisateur=i.id_emetteur) WHERE id_recepteur=:id");
            $this->conn->bind("id",$id);
            $invitaions=$this->conn->resultset();
            if($this->conn->rowCount()>=0){
                return $invitaions;
            }
        }

        //Cette fonction permet d'envoyer un invitation
        public function EnvoyerInvitation($idE,$idR){
            $this->conn->query("INSERT INTO invitation(id_invitation,id_emetteur,id_recepteur,date_invitation) values (NULL,:idR,:idE,:date_inv)");
            $this->conn->bind("idR",$idE);
            $this->conn->bind("idE",$idR);
            
            $this->conn->bind("date_inv",date("Y-m-d H:i:s"));
            $this->conn->execute();
            if($this->conn->rowCount()==1){
                return true;
            }
            return false;
        }

        //cette fonction permet au utilisateur soit d'accepter ou de regeter un invitation
        public function decision($id,$status){
            $this->conn->query("UPDATE invitation SET status=:status WHERE id_invitation=:id");
            $this->conn->bind("status",$status);
            $this->conn->bind("id",$id);
            $this->conn->execute();

            if($this->conn->rowCount()==1){
                return true;
            }
            return false;
        }

        public function update($bio,$education,$Location,$skills,$notes,$img,$id,$age,$gendre){
            $this->conn->query("UPDATE utilisateur SET image_profil=:img , apropos=:bio , education=:education , location=:Location , notes=:notes,skills=:skills , Sexe=:gendre, Date_naissance=:age WHERE id_utilisateur=:id  ");
            $this->conn->bind("img",$img);
            $this->conn->bind("bio",$bio);
            $this->conn->bind("education",$education);
            $this->conn->bind("Location",$Location);
            $this->conn->bind("skills",$skills);
            $this->conn->bind("notes",$notes);
            $this->conn->bind("id",$id);
            $this->conn->bind("age",$age);
            $this->conn->bind("gendre",$gendre);

            $this->conn->execute();

            if($this->conn->rowCount()>=1)
                    return true;
            
            return false;
            
        }
    }


?>