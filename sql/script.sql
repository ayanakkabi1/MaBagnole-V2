CREATE DATABASE IF NOT EXISTS mabagnole;
USE mabagnole;


CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe_hash VARCHAR(255) NOT NULL,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
    description TEXT
);

CREATE TABLE vehicules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    modele VARCHAR(100) NOT NULL,
    immatriculation VARCHAR(50) UNIQUE NOT NULL,
    prix_jour DECIMAL(10,2) NOT NULL,
    id_categorie INT NOT NULL,
    disponible BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_categorie) REFERENCES categories(id)
);

CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT NOT NULL,
    id_vehicule INT NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    lieu_depart VARCHAR(100),
    lieu_retour VARCHAR(100),
    statut VARCHAR(50),
    FOREIGN KEY (id_client) REFERENCES clients(id),
    FOREIGN KEY (id_vehicule) REFERENCES vehicules(id)
);

CREATE TABLE avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT NOT NULL,
    id_vehicule INT NOT NULL,
    note INT CHECK (note BETWEEN 1 AND 5),
    commentaire TEXT,
    soft_deleted BOOLEAN DEFAULT FALSE,
    date_avis DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_client) REFERENCES clients(id),
    FOREIGN KEY (id_vehicule) REFERENCES vehicules(id)
);

INSERT INTO categories (nom, description) VALUES
('Voiture', 'Véhicules de tourisme'),
('Moto', 'Deux roues motorisées'),
('Utilitaire', 'Véhicules pour transport de marchandises');

INSERT INTO vehicules (modele, immatriculation, prix_jour, id_categorie, disponible) VALUES
('Toyota Yaris', 'AA-123-BB', 300.00, 1, TRUE),
('Dacia Duster', 'CC-456-DD', 450.00, 1, TRUE),
('Yamaha MT-07', 'EE-789-FF', 200.00, 2, TRUE),
('Renault Kangoo', 'GG-111-HH', 500.00, 3, FALSE);

SELECT * FROM vehicules;
CREATE TABLE themes(
    id_theme int AUTO_INCREMENT  PRIMARY KEY,
    titre_theme varchar(50) NOT NULL,
    description_theme varchar(2500),
    actif BOOLEAN DEFAULT TRUE 
)
CREATE TABLE articles(
    id_article int AUTO_INCREMENT PRIMARY KEY,
    id_theme int NOT NULL,
    id_client int NOT NULL,
    titre_article varchar(50) NOT NULL,
    contenu varchar(5000),
    tags varchar(200),
    date_publication DATE,
    status BOOLEAN DEFAULT TRUE,

   FOREIGN KEY (id_theme) REFERENCES themes(id_theme),
   FOREIGN KEY (id_client) REFERENCES users(id)
)
CREATE TABLE commentaires(
    id_commentaire int AUTO_INCREMENT PRIMARY KEY,
    id_client int NOT NULL,
    id_article int NOT NULL,
    titre_com varchar(50),
    contenu_com varchar(5000),
    date_commentaire DATE DEFAULT CURRENT_Date,
    soft_deleted BOOLEAN DEFAULT FALSE,

   FOREIGN KEY (id_article) REFERNCES articles(id_article),
   FOREIGN KEY (id_client) REFERNCES users(id_client)
)
INSERT INTO themes (titre_theme, description_theme, actif) VALUES
('Voitures électriques', 'Actualités et innovations sur les voitures électriques', TRUE),
('Entretien automobile', 'Conseils et bonnes pratiques pour l entretien des voitures', TRUE),
('Comparatifs auto', 'Comparaison entre différents modèles de voitures', TRUE);

INSERT INTO users(nom,email,mot_de_passe_hash,date_creation,role) VALUES 
('admin','admin@gmail.com', SHA2('admin', 256) , '2025-12-16','admin');

INSERT INTO articles (id_theme, id_client, titre_article, contenu, tags, date_publication, status) VALUES
(1, 1, 'CHANGER SON JOINT DE CULASSE', 'Le joint de culasse est l''un des composants les plus critiques de votre moteur. Ce dossier technique de 3000 mots détaille chaque étape : de la vidange du liquide de refroidissement jusqu''au serrage au couple spécifique des vis de culasse...', 'TUTO, MOTEUR, RÉPARATION', '2026-01-02', 1),

(4, 1, 'L''HÉRITAGE DE LA SKYLINE GT-R', 'Surnommée "Godzilla", la Nissan Skyline GT-R a dominé les circuits japonais avant de conquérir le monde. Nous analysons ici l''évolution du moteur RB26DETT et pourquoi cette voiture reste un investissement majeur aujourd''hui...', 'HISTOIRE, JDM, ICONE', '2026-01-04', 1),

(2, 1, 'LA MÉTHODE DES DEUX SEAUX', 'Le detailing ne s''improvise pas. Pour éviter les micro-rayures sur votre peinture noire vernie, la méthode des deux seaux est indispensable. Voici comment préparer votre eau, choisir votre gant en microfibre et sécher sans contact...', 'NETTOYAGE, DETAILING, LOOK', '2026-01-05', 1),

(3, 1, 'COMPRENDRE LES CODES OBD-II', 'Votre voyant moteur est allumé ? Pas de panique. Ce guide explique comment lire les codes d''erreur avec une interface ELM327 et interpréter les codes P0xxx pour diagnostiquer un mélange trop pauvre ou un raté d''allumage...', 'TECH, DIAGNOSTIC, DIY', '2026-01-07', 1);
CREATE table Tags (
    id_tags int AUTO_INCREMENT PRIMARY KEY ,
    titre_tags varchar(50)
);
INSERT INTO tags (titre_tags) VALUES
('Économique'),
('SUV'),
('Automatique'),
('Diesel'),
('Essence'),
('Électrique'),
('Familiale'),
('Luxe');
CREATE table article_tags(
    id_article INT NOT NULL,
    id_tags INT NOT NULL,
    PRIMARY key(id_article,id_tags),
    FOREIGN KEY (id_article) REFERENCES articles (id_article),
    FOREIGN KEY (id_tags) REFERENCES tags (id_tags)
)
INSERT INTO article_tags (id_article, id_tag) VALUES

(12, 3), 
(12, 4), 
(12, 5), 

(13, 8), 
(13, 7), 

(14, 1),
(14, 7),

(15, 6), 
(15, 3); 
ALTER TABLE tags
CHANGE id_tags id_tag INT AUTO_INCREMENT;
