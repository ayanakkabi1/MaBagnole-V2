//CREATE TABLE themes(
    id_theme int AUTO_INCREMENT  PRIMARY KEY,
    titre_theme varchar(50) NOT NULL,
    description_theme varchar(2500),
    actif BOOLEAN DEFAULT TRUE 
)

<?php
class theme{
    private $id_theme;
    private $titre_theme;
    private $description_theme;
    private $actif;
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

}
?>