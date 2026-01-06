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
