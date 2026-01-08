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
    public static function listerTous(PDO $pdo){
        $sql="SELECT * FROM tags";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $tags = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($tags as $tag){
            $tag_OBJ = new Tag($tag->id_tag,$tag->titre_tag);
            $tags[] = $tag_OBJ;
        }
        return $tags;
     }

}
?>