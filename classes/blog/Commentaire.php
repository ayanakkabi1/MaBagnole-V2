//id_commentaire	id_client	id_article	titre_com	contenu_com	date_commentaire	soft_deleted	
<?php
class Commentaire{

    private $id_commentaire;
    private $titre_com;
    private $contenu_com;
    private $soft_deleted;
    public function __construct($titre_com, $contenu_com,$soft_deleted = false)
    {
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
    
}
?>