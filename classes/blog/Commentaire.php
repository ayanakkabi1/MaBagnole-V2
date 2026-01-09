<?php

namespace Blog;

use PDO;

class Commentaire
{

    private $id_commentaire;
    private $id_client;
    private $id_article;
    private $titre_com;
    private $contenu_com;
    private $date_commentaire;
    private $soft_deleted;
    public function __construct($id_client, $id_article, $titre_com, $contenu_com, $soft_deleted = false)
    {
        $this->id_client = $id_client;
        $this->id_article = $id_article;
        $this->titre_com = $titre_com;
        $this->contenu_com = $contenu_com;
        $this->soft_deleted = $soft_deleted;
    }
    public function __get($att)
    {
        if (property_exists($this, $att)) {
            return $this->$att;
        }
        return null;
    }
    public function __set($att, $value)
    {
        if (!property_exists($this, $att)) {
            return false;
        }
        if ($att === 'soft_deleted') {
            $value = (bool) $value;
        }
        $this->$att = $value;
    }

    public static function listerParArticle($pdo, $idArticle)
    {
        $sql = "Select * FROM commentaires where id_article=:idArticle";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':idArticle' => $idArticle]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ajouter($pdo)
    {
        $sqlInsert = "INSERT INTO commentaires (id_client, id_article, titre_com, contenu_com, date_commentaire, soft_deleted) 
                  VALUES (:id_client, :id_article, :titre, :contenu, NOW(), 0)";

        $stmt = $pdo->prepare($sqlInsert);
        $success = $stmt->execute([
            ':id_client'  => $this->id_client,
            ':id_article' => $this->id_article,
            ':titre'      => $this->titre_com,
            ':contenu'    => $this->contenu_com
        ]);
    }
    public static function listerParClient(PDO $pdo, int $id_client): array
    {
        $sql = "SELECT *
            FROM commentaires
            WHERE id_client = :id_client
            AND soft_deleted = 0
            ORDER BY date_commentaire DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id_client' => $id_client
        ]);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public static function modifierCommentaire(
        PDO $pdo,
        int $id_commentaire,
        string $titre_com,
        string $contenu_com
    ) {
        $sql = "UPDATE commentaires
        SET titre_com = :titre,
            contenu_com= :contenu
        WHERE id_com = :id_commentaire";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':titre' => $titre_com,
            ':contenu' => $contenu_com,
            ':id_commentaire' => $id_commentaire
        ]);
    }
}
