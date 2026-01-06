//CREATE TABLE articles(
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
),	
<?php
class Article{

    private $id_article;
    private $id_theme;
    private $id_client;
    private $titre_article;
    private $contenu;
    private $tags;
    private $date_publication;
    private $status;
    
    

    public function __construct($id_theme,$id_client,$titre_article, $contenu,$tags,$status = TRUE)
    {   
        $this->id_theme=$id_theme;
        $this->id_client=$id_client;
        $this->titre_article=$titre_article;
        $this->contenu=$contenu;
        $this->tags=$tags;
        $this->status=$status;
    }
    public function __get($att)
    {
         if (property_exists($this, $att)) {
            return $this->$att;
        }
        return null;
    }
    public function __set($att, $value){
          if (!property_exists($this, $att)) {
            return false;
        }
        if ($att === 'status') {
            $value = (bool) $value;
        }

        $this->$att = $value;
    }
    
}
?>