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

   FOREIGN KEY (id_theme) REFERNCES themes(id_theme),
   FOREIGN KEY (id_client) REFERNCES users(id)
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


