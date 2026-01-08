<?php
namespace Blog;
use PDO;	
class Commentaire{

    private $id_commentaire;
    private $id_client;
    private $id_article;
    private $titre_com;
    private $contenu_com;
    private $date_commentaire;
    private $soft_deleted;
    public function __construct($id_client,$id_article,$titre_com, $contenu_com,$soft_deleted = false)
    {
        $this->id_client=$id_client;
        $this->id_article=$id_article;
        $this->titre_com=$titre_com;
        $this->contenu_com=$contenu_com;
        $this->soft_deleted=$soft_deleted;
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
        if ($att === 'soft_deleted') {
            $value = (bool) $value;
        }
        $this->$att = $value;
    }
    
    public static function listerParArticle($pdo, $idArticle){
        $sql="Select * FROM commentaires where id_article=:idArticle";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':idArticle' => $idArticle]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>