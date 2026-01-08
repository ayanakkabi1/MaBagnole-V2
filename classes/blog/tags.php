
<?php
class Tag{
    private $id_tags;
    private $titre_tags;
    public function __construct($titre_tags)
    {
        $this->titre_tags=$titre_tags;
    }
       public function __get(string $name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
       return null;
    }

  
    public function __set(string $name, $value) {
    if (property_exists($this, $name)) {
        $this->$name = $value;
    }
}

}
?>