<?php

require_once 'ServerAuth/Role.php';
require_once 'lib/ConnBD.php';

class Users {
    private $username;
    private $password;
    private $role;
    private $pdo;



    public function __construct($username, $password,$role) {
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    //getters
    public function getUsername():string {
        return $this->username;
    }

    public function getPassword():string {
        return $this->password;
    }

    public function liste():array {
        $sql = "SELECT * FROM userc WERE username = :username AND password = :password";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(':username' => $this->username,':password' => $this->password));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;

    }

    //test si l'utilisateur est un moderateur
    public function isModerator():bool {
        return $this->role ==='moderator';
    }

    //test si l'utilisateur est un editeur
    public function isPublisher():bool{
        return $this->role ==='publisher';
    }

    /*test si l'utilisateur est un anonyme
    public function isUser():bool {
        return $this->role ==='anonyme';
    }
    */
    
}

?>