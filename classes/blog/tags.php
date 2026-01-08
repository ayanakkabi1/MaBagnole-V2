<?php
class Tag
{
    private $id_tag;
    private $titre_tag;
    public function __construct($id_tag = null, $titre_tag)
    {
        $this->titre_tag = $titre_tag;
        $this->id_tag = $id_tag;
    }
    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return null;
    }


    public function __set(string $name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }
    public static function listerTous(PDO $pdo)
    {
        $sql = "SELECT * FROM tags";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $tags = [];
        while ($tag = $stmt->fetch()) {
            $tag_OBJ = new Tag($tag["id_tag"], $tag["titre_tags"]);
            array_push($tags, $tag_OBJ);
        }
        return $tags;
    }
} 
