<?php
    require_once 'Client.php ';
    require_once __DIR__ . '/../database/Database.php';

    class Commande {
        private $id;
        private $price;
        private $statu;
        private $date_commande;
        private $id_client;

        public function __construct($price , $id_client, $statu = 'pending', $date_commande = null, $id = null) {
            $this->price = $price;
            $this->id_client = $id_client ;
            $this->statu = $statu;
            $this->date_commande = $date_commande ?? date ('Y-m-d');
            $this->id = $id;
        }

        public function get_id() {
             return $this->id;
        }
        public function get_price() {
             return $this->price;
         }
        public function get_statu() {
             return $this->statu; 
        }
        public function get_date() { 
            return $this->date_commande;
        }
        public function get_client_id() { 
            return $this->id_client;
        }

        public function enregistre_comande() {
            $db = new Database();
            $conn = $db->getConnection();
            $stmt = $conn->prepare("INSERT INTO commandes (price, statu, date_commande, id_client)
            VALUES (?, ?, ?, ?)");
            $stmt->execute([$this->price, $this->statu, $this->date_commande, $this->id_client]);
            $this->id = $conn->lastInsertId();
        }

        public static function get_all() {
            $db = new Database();
            $conn = $db->getConnection();
            $stmt = $conn->query("SELECT * FROM commandes");

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function get_com_Pending() {
            $db = new Database();
            $conn = $db->getConnection();
            $stmt = $conn->query("SELECT * FROM commandes WHERE statu='pending'");

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function adap_Statu($id, $statu) {
            $db = new Database();
            $conn = $db->getConnection();
            $stmt = $conn->prepare("UPDATE commandes SET statu=? WHERE id=?");
            $stmt->execute([$statu, $id]);
        }
    }
