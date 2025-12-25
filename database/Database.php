<?php
    class Database{

        private $host = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname =  "systeme_paiement";
        private $conn;

        private function conn(){
            try {
                $this->conn = new PDO(
                    "mysql:host=" . $this->host . ";dbname=" . $this->dbname,
                    $this->username,
                    $this->password,
                );
                
                echo "conexion a ete avec un succée";
        }catch(PDOException $e){
            die("Erreur du serveur!") ;
        }
        }

        public function __construct(){
            $this->conn();
        }
    }
    $conn = new Database();
    var_dump($conn);
?>