<?php
class Database{

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname =  "systeme__paiement";
    private $conn;

    private function conn(){
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbname,
                $this->username,
                $this->password
            );
            // echo "conexion a ete avec un succée\n";
        } catch(PDOException $e){
            die("Erreur du serveur!") ;
        }
    }
    public function get_connection() {
        return $this->conn;
    }

    public function __construct(){
        $this->conn();
    }

}
    // var_dump("nadi canadi",$conn);

