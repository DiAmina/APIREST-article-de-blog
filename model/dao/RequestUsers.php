<?php
namespace model\dao;

require_once (__DIR__ . "/../User.php");
use model\User;
use PDO;

class RequestUsers{
    private $pdo;

    //Constructeur pour connexion BD
    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection();
    }

    //Récupère un user dans la BD
    public function getUser($login, $password) {
        $query = $this->pdo->prepare("SELECT * FROM users WHERE login = :login AND password = :password");
        $query->execute([
            "login" => $login,
            "password" => $password
        ]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            return null;
        }
        return new User($user["login"], $user["password"], $user["role"]);
    }

    //Update un user
    public function updateUser($login, $password): bool {
        $query = $this->pdo->prepare("UPDATE users SET login = :login, password = :password");
        return $query->execute([
            "login" => $login,
            "password" => $password
        ]);
    }

    //Delete un user
    public function deleteUser($login, $password): bool {
        $query = $this->pdo->prepare("DELETE FROM users WHERE login = :login AND password = :password");
        return $query->execute([
            "login" => $login,
            "password" => $password
        ]);
    }



}
