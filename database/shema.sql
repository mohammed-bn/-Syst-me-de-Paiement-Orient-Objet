CREATE DATABASE systeme__paiement;
use  systeme__paiement;
CREATE TABLE users(
	id int PRIMARY KEY AUTO_INCREMENT ,
	name varchar(255) NOT NULL,
	email varchar(255) NOT NULL
);

CREATE TABLE commandes(
	id int PRIMARY KEY AUTO_INCREMENT ,
    price int NOT NULL,
    statu ENUM('pending', 'cancle', 'ressive'),
    date_commande date,
    id_client int,
    FOREIGN KEY (id_client) REFERENCES users (id)
);

CREATE TABLE payment(
	id int AUTO_INCREMENT PRIMARY KEY,
    price int NOT NULL,
    statu ENUM('pendin', 'cancle', 'ressive'),
    date_operation  date,
    id_commande int,
    FOREIGN KEY (id_commande) REFERENCES commandes (id)
);

CREATE TABLE carte_bancair(
	id int AUTO_INCREMENT PRIMARY KEY,
    numero_catre int NOT NULL,
    type_catre varchar(255),
    id_payment int,
    FOREIGN KEY (id_payment) REFERENCES payment (id)
    
);

CREATE TABLE paypal (
	name varchar(255) NOT NULL,
    email varchar (255) NOT NULL,
   id_payment int,
    FOREIGN KEY (id_payment) REFERENCES payment (id)
);

CREATE TABLE vairment(
	name varchar(255) NOT null,
    rib int NOT null,
    id_payment int,
    FOREIGN KEY (id_payment) REFERENCES payment (id)
);