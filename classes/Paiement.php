<?php
require_once 'Commande.php';
require_once __DIR__ . '/../database/Database.php';

abstract class Paiement {
    protected $id;
    protected $price;
    protected $statu;
    protected $date_operation;
    protected $id_commande;

    public function __construct($price, $id_commande, $statu='pendin', $date_operation=null, $id=null) {
        $this->price = $price;
        $this->id_commande = $id_commande;
        $this->statu = $statu;
        $this->date_operation = $date_operation ?? date('Y-m-d');
        $this->id = $id;
    }

    abstract public function payer();

    public function enregistre() {
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO payment (price, statu, date_operation, id_commande) 
        VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->price, $this->statu, $this->date_operation, $this->id_commande]);
        
        $this->id = $conn->lastInsertId();
    }
}
