<?php

class PubController extends Controller{
    
    public function __construct()
    {
        $this->User=$this->model("Utilisateur");
        $this->Pub=$this->model("Publication");
    }

    public function addPub(){
         $id=$_SESSION["id_user"];;
        
        $contenu=$_POST["contenu"];

        //Configuration d'image
        
        $images=$_FILES['pub']['name'];
        $tmp_dir=$_FILES['pub']['tmp_name'];
        $imageSize=$_FILES['pub']['size'];
        $upload_dir='uploads/pubs/';
        $imgEXT=strtolower(pathinfo($images,PATHINFO_EXTENSION));
        $valid_extensions=array('jpeg','jpg','png','gif','mp4');
        $fichier=rand(1000,1000000).".".$imgEXT;


        if($this->Pub->insertPub($id,$fichier,$contenu)){
            move_uploaded_file($tmp_dir, $upload_dir.$fichier);

            redirect("User");
        
        }

    }

    public function addComment(){
        $id=$_SESSION["id_user"];
        $id_pub=$_POST["id_pub"];
        $comment=$_POST["contenu"];
        if($this->Pub->add_comment($id_pub,$id,$comment)){
            echo "yeey";
        }
    }

    public function deleteComment(){
        $id_commentaire=$_POST["id_commentaire"];
        if($this->Pub->delete_comment($id_commentaire)){
            echo "yes";
        }
    }

    public function  likePub(){
         $id_pub=$_POST["id_pub"];
         $id_user=$_SESSION["id_user"];

        if($this->Pub->add_like($id_pub,$id_user)){
            echo "yeey";
        }
        
    }

    


}


?>