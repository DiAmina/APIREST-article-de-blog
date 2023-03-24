<?php
namespace model\dao;

use PDO;

class RequestUsers{
    private $pdo;

    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getUser($login, $password): ?array {
        $query = $this->pdo->prepare("SELECT * FROM userc WHERE login = :login AND password = :password");
        $query->execute([
            "login" => $login,
            "password" => $password
        ]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($login, $password): bool {
        $query = $this->pdo->prepare("UPDATE userc SET login = :login, password = :password");
        return $query->execute([
            "login" => $login,
            "password" => $password
        ]);
    }

    public function deleteUser($login, $password): bool {
        $query = $this->pdo->prepare("DELETE FROM userc WHERE login = :login AND password = :password");
        return $query->execute([
            "login" => $login,
            "password" => $password
        ]);
    }

}
