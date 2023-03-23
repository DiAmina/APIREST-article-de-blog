<?php

class Role {
    private $username;
    private $password;
    private $role;

    public function __construct($username, $password,$role) {
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    public function liste():array {
        return array(
            'username' => $this->username,
            'password' => $this->password,
            'role' => $this->role
        );
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