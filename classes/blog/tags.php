<?php
class Tag{
    private $id_tag;
    private $titre_tag;
    public function __construct($titre_tag)
    {
        $this->titre_tags=$titre_tag;
    }
       public function __get(string $name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
       return null;
    }

  
    public function __set(string $name, $value){
    if (property_exists($this, $name)) {
        $this->$name = $value;
    }
}

}
?>