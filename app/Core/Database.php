<?php
    class Database {
        private $host = DB_HOST;
        private $user = DB_USER;
        private $password= DB_PWD;
        private $dbname=DB_NAME;
        private $conn;
        private $stmt; 
        public function __construct()
        {
            try {
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                 // set the PDO error mode to exception
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            }
            catch(PDOException $e)
                {
                   redirect("Home/error"); 
            }   
        } 


        // Papared statement
        public function query($sql) {
            $this->stmt= $this->conn->prepare($sql);
        }

        // Bind parameters
        public function bind($param, $value, $type= NULL) {
            if(is_null($type)) {
                switch(true) {
                                                        
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type=PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type= PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
                $this->stmt->bindvalue($param, $value, $type);
            }
        }   
        // Execute the prepared statement
        public function execute() {
            return $this->stmt->execute();
        }

        // Get multiple records as the result
        public function resultset() {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Get single record as the single result
        public function single() {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        }

        //nombre des lignes
        public function rowCount(){
            return  $this->stmt->rowCount();
        }
    }
?>