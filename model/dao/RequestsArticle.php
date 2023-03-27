<?php

namespace model\dao;

require_once (__DIR__ . "/Database.php");
use model\dao\Database;
use PDO;

class RequestsArticle
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getArticles(): array
    {
        $query = $this->pdo->prepare("SELECT * FROM article");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticleId($id): array
    {
        $query = $this->pdo->prepare("SELECT * FROM article WHERE id = :id");
        $query->execute([
            "id" => $id
        ]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getArticleAuteur($auteur): array
    {
        $query = $this->pdo->prepare("SELECT * FROM article WHERE auteur = :auteur");
        $query->execute([
            "auteur" => $auteur
        ]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    //le nombre de like
    public function getLikes($id): array
    {
        $query = $this->pdo->prepare("SELECT COUNT(*) FROM likes WHERE id = :id");
        $query->execute([
            "id" => $id
        ]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    //le nombre de dislike
    public function getDislikes($id): array
    {
        $query = $this->pdo->prepare("SELECT COUNT(*) FROM dislikes WHERE id = :id");
        $query->execute([
            "id" => $id
        ]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    function postArticle($auteur, $contenu, $datePub): bool
    {
        $query = $this->pdo->prepare("INSERT INTO article (auteur, contenu, datePub) VALUES (:auteur, :contenu, :date)");
        return $query->execute([
            "auteur" => $auteur,
            "contenu" => $contenu,
            "date" => $datePub
        ]);
    }

    // Méthode pour mettre à jour partiellement un article
    public function patchArticle($id, $contenu): bool {
        $query = $this->pdo->prepare("UPDATE articles SET contenu = CONCAT_WS('', contenu, :contenu) WHERE id = :id");
        return $query->execute([
            "id" => $id,
            "contenu" => $contenu
        ]);
    }

    // Méthode pour mettre à jour un article
    function  putArticle($id, $contenu): bool
    {
        $query = $this->pdo->prepare("UPDATE article SET contenu = :contenu WHERE id = :id");
        return $query->execute([
            "id" => $id,
            "contenu" => $contenu
        ]);
    }

    function deleteLike($id): bool
    {
        $query = $this->pdo->prepare("DELETE FROM likes WHERE id = :id");
        return $query->execute([
            "id" => $id
        ]);
    }

    function deletedislike($id): bool
    {
        $query = $this->pdo->prepare("DELETE FROM dislikes WHERE id = :id");
        return $query->execute([
            "id" => $id
        ]);
    }
    function deleteArticle($id): bool
    {
        $query = $this->pdo->prepare("DELETE FROM article WHERE id = :id");
        return $query->execute([
            "id" => $id
        ]);
    }

    function postLike($id, $auteur): bool
    {
        $query = $this->pdo->prepare("INSERT INTO likes (id, username) VALUES (:id, :auteur)");
        return $query->execute([
            "id" => $id,
            "auteur" => $auteur
        ]);
    }
    function postDislike($id, $auteur): bool
    {
        $query = $this->pdo->prepare("INSERT INTO dislikes (id, username) VALUES (:id, :auteur)");
        return $query->execute([
            "id" => $id,
            "auteur" => $auteur
        ]);
    }
}
