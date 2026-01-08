<?php
class ArticleTag {
    private int $id_article;
    private int $id_tag;

    public function __construct(int $id_article, int $id_tag) {
        $this->id_article = $id_article;
        $this->id_tag = $id_tag;
    }

    public function __get(string $name) {
        return property_exists($this, $name) ? $this->$name : null;
    }


    public function __set(string $name, $value): void {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }
}
?>
