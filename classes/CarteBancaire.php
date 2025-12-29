<?php
require_once 'Paiement.php';

class CarteBancaire extends Paiement {
    private $numero_catre;
    private $type_catre;

        public function __construct($price, $id_commande, $numero_catre, $type_catre) {
        parent::__construct($price, $id_commande);
        $this->numero_catre = $numero_catre;
        $this->type_catre = $type_catre;
    }

    public function payer() {
        $this->statu = 'ressive';
        $this->enregistre();

        $db = new Database();
        $conn = $db->get_connection();
        $stmt = $conn->prepare("INSERT INTO carte_bancair (numero_catre, type_catre, id_payment) 
        VALUES (?, ?, ?)");
        $stmt->execute([$this->numero_catre, $this->type_catre, $this->id]);

        Commande::adap_Statu($this->id_commande, 'ressive');

        echo "paiement a ete termini avec succée.";
    }

   
}
