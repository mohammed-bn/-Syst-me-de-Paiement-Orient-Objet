<?php
require_once 'classes/Client.php';
require_once 'classes/Commande.php';
require_once 'classes/CarteBancaire.php';


do{

    echo "__le menu de Systeme Paiement__ \n";
    echo "==============================\n\n";
    echo "1_ Créer un client\n";
    echo "2_ Créer une commande\n";
    echo "3_ Payer une commande\n";
    echo "4_ Afficher les commandes\n";
    echo "0_ Quitter\n\n";
    $choice = readline("Votre choix : ");

    switch($choice) {
        case 1:
            $name = readline("name : ");
            $email = readline("email : ");
            $client = new Client($name, $email);
            if($client->validation()) {
                $client->enregistre();
                echo "client crée id: " . $client->get_id() . "\n";
            } else echo "information non validée!.\n";
            break;

        case 2:
            $clients = Client::get_all();
            foreach($clients as $c) echo "{$c['id']}. {$c['name']} ({$c['email']})\n";
            $id_client = readline("entre le id de clien : ");
            $price = readline("entre price de la commande : ");
            $commande = new Commande($price, $id_client);
            $commande->enregistre_comande();
            echo "commande créer id: " . $commande->get_id() . "\n";
            break;

        case 3:
            $pending = Commande::get_com_Pending();
            foreach($pending as $c) echo "{$c['id']}. ClientID: {$c['id_client']} : {$c['price']} Statut: {$c['statu']}\n";
            $id_commande = readline("ID de la commande à payer : ");
            echo("1_Carte.\n");
            echo("2_PayPal.\n");
            echo("3_Virement.\n");
            $type = readline("entre ici votre choix : ");

            $commande = null;
            foreach($pending as $c) if($c['id'] == $id_commande) $commande = $c;
            if(!$commande) { echo "Commande introuvable.\n"; break; }

            switch($type) {
                case 1:
                    $numero = readline("numéro de carte : ");
                    $type_carte = readline("type de carte : ");
                    $paiement = new CarteBancaire($commande['price'], $id_commande, $numero, $type_carte);
                    $paiement->payer();
                    break;
                case 2:
                    echo ("paypal");
                case 3:
                    echo("vérmont");
                default: echo "Paiement invalide.\n";
            }
            break;

        case 4:
            $all = Commande::get_all();
            foreach($all as $c) echo "CommandeID: {$c['id']} ClientID: {$c['id_client']} Montant: {$c['price']} Statut: {$c['statu']} Date: {$c['date_commande']}\n";
            break;

        case 0:
            exit;

        default: echo "le nomber incoorect!\n entre un nomber entre 0 et 4.\n";
    }
}while($choix >= 0  || $choix < 5);

