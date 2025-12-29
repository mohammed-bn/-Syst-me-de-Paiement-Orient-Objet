<?php

    require_once __DIR__ . '/../database/Database.php';

    class Client {

        private $id;
        private $name;
        private $email;

        public function __construct($name ,$email ,$id = null) {

            $this->name = $name;
            $this->email = $email;
            $this->id = $id;

        }

        public function get_id() { 
            return $this->id;
        }
        public function get_name() { 
            return $this->name; 
        }
        public function get_email() {
            return $this->email;
        }

        public function validation() {
            return !empty($this->name) && !empty($this->email);
        }

        public function enregistre() {

            $db = new Database();
            $conn = $db->get_connection();
            $stmt = $conn->prepare("INSERT INTO users (name , email) VALUES (?, ?)");
            $stmt->execute([$this->name, $this->email]);

            $this->id = $conn->lastInsertId();
        }

        public static function get_all() {
            $db = new Database();
            $conn = $db->get_connection();
            $stmt = $conn->query("SELECT * FROM users");
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
