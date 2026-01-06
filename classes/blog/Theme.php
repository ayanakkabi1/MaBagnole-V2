<?php
namespace Blog;
use PDO;

class Theme{
    private $id_theme;
    private $titre_theme;
    private $description_theme;
    private $actif;
    private $pdo;
    public function __construct($titre_theme, $description_theme,$actif = true)
    {
        $this->titre_theme=$titre_theme;
        $this->description_theme=$description_theme;
        $this->actif=$actif;
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
        if ($att === 'actif') {
            $value = (bool) $value;
        }

        $this->$att = $value;
    }
    
    public static function listerTousActifs(PDO $pdo){
        $sql="SELECT * FROM themes where actif=1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>