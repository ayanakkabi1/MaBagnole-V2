<?php
namespace Blog;
use PDO;
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
    //listerParTheme($pdo, $idTheme)
    //trouverParId($pdo, $id)
    public static function listerParTheme($pdo, $idTheme){
        $sql="SELECT * FROM article where id_theme=:idTheme";
         $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function trouverParId($pdo, $id){
        $sql="SELECT * FROM article where id_article=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     //rechercherParTitre($pdo, $motCle) utilisant LIKE.
    public static function rechercherParTitre($pdo, $motCle){
        $sql="SELECT * FROM article
        where titre_article Like 'motCle'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function insert(PDO $pdo): bool {
        $sql = "INSERT INTO articles 
                (id_theme, id_client, titre_article, contenu, date_publication, status)
                VALUES (:id_theme, :id_client, :titre_article, :contenu, NOW(), 1)";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':id_theme' => $this->id_theme,
            ':id_client' => $this->id_client,
            ':titre_article' => $this->titre_article,
            ':contenu' => $this->contenu,
            ':date_publication' => $this->date_publication,
            ':status' => $this->status
        ]);
    }
    
}
?>  