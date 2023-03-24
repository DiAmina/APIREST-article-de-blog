<?php

namespace model\dao;
class RequestUsers{
    private $pdo;

    public function __construct(){
        $this->pdo = Database::getInstance();
    }

    public function getUser($login, $password){
        $query = $this->pdo->prepare("SELECT * FROM userc WHERE login = :login AND password = :password");
        $query->execute([
            "login" => $login,
            "password" => $password
        ]);
        return $query->fetch();
    }
}
