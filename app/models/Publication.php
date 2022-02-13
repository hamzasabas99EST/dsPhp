<?php

    class Publication{
        
        private $conn;
       
        public function __construct()
        {
            $this->conn=new Database();
           
        }
        

        //Cette fonction permet d'afficher les publication d'utilisateur
        public function mesPublications($id){
            $this->conn->query("SELECT p.*,u.fullname,u.image_profil,COUNT(a.id_publication) as  'likes' FROM publication  p  JOIN utilisateur u USING(id_utilisateur)  LEFT JOIN aime a USING(id_publication)  WHERE p.id_utilisateur=:id GROUP BY p.id_publication  " );
            $this->conn->bind("id",$id);
            $mypubs=$this->conn->resultset();
            if($this->conn->rowCount()>=0){
                return $mypubs;
            }
        }

        //Cette fonction permet d'afficher les publications des amis d'utilisateur
        public function NotMyPubs(){
            $this->conn->query("SELECT p.*,u.fullname,u.image_profil,COUNT(a.id_publication) as  'likes' FROM publication  p  JOIN utilisateur u USING(id_utilisateur)  LEFT JOIN aime a USING(id_publication) GROUP BY p.id_publication ORDER BY id_publication DESC ;" );
            $pubs=$this->conn->resultset();
            if($this->conn->rowCount()>=0){
                return $pubs;
            }
        }

        public function insertPub($id,$fichier,$contenu){
            $this->conn->query("INSERT INTO publication (id_publication,image,contenu_text,date_ajout,id_utilisateur) VALUES (NULL,:fichier,:contenu,:date_a,:id)");
            $this->conn->bind('fichier',$fichier);
            $this->conn->bind('contenu',$contenu);
            $this->conn->bind('date_a',date("Y-m-d H:i:s"));
            $this->conn->bind('id',$id);
            
            $this->conn->execute();
            if($this->conn->rowCount()==1) return true;
            return false;
        }

        public function Commentaires(){
            $this->conn->query("SELECT c.*,u.fullname,u.image_profil FROM commentaire  c  JOIN utilisateur u USING(id_utilisateur) JOIN publication p USING (id_publication)"  );
            $comments=$this->conn->resultset();
            if($this->conn->rowCount()>=0){
                return $comments;
            }
        }

        public function add_comment($id_pub,$id_user,$contenu){
            $this->conn->query("INSERT INTO commentaire (id_commentaire,id_publication,id_utilisateur,contenu,date_commentaire) VALUES (NULL,:id_pub,:id,:contenu,:date_c)");
            $this->conn->bind('id_pub',$id_pub);
            $this->conn->bind('id',$id_user);
            $this->conn->bind('contenu',$contenu);
            $this->conn->bind('date_c',date("Y-m-d H:i:s"));
            
            $this->conn->execute();
            if($this->conn->rowCount()==1) return true;
            return false;
       
        }

        public function delete_comment($id){
            $this->conn->query("DELETE FROM commentaire WHERE id_commentaire=:id");
            $this->conn->bind('id',$id);
            $this->conn->execute();
            if($this->conn->rowCount()==1) return true;
            return false;    
        }

        public function add_like($id_pub,$id_user){
            $this->conn->query("INSERT INTO aime (id_aime,id_publication,id_utilisateur) VALUES (NULL,:id_pub,:id)");
            $this->conn->bind('id_pub',$id_pub);
            $this->conn->bind('id',$id_user);
            $this->conn->execute();
            if($this->conn->rowCount()==1) return true;
            return false;
            
        }

        public function delete_like($id_pub,$id_user){
            $this->conn->query("DELETE FROM aime WHERE id_publication=:id_pub AND id_utilisateur=:id)");
            $this->conn->bind('id_pub',$id_pub);
            $this->conn->bind('id',$id_user);
            $this->conn->execute();
            if($this->conn->rowCount()==1) return true;
            return false;
            
        }

        public function is_liked($id_pub,$id_user){
            $this->conn->query("SELECT * FROM aime WHERE id_publication=:id_pub AND id_utilisateur=:id");
            $this->conn->bind('id_pub',$id_pub);
            $this->conn->bind('id',$id_user);

            $this->conn->execute();
            if($this->conn->rowCount()==1) return true;
            else return false;

            

        }

        public function likesofUser($id){
            $this->conn->query("SELECT * FROM aime WHERE id_utilisateur=:id" );
            $this->conn->bind("id",$id);
            $this->conn->execute();
            
            if($this->conn->rowCount()>=0){
                return $this->conn->rowCount();
            }
        }
        
        
    }




?>