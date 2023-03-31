<?php
namespace model;

class User
{
    private $login;
    private $password;
    private $role;

    //créer un login, un password et un rôle
    public function __construct($login, $password, $role)
    {
        $this->login = $login;
        $this->password = $password;
        $this->role = $role;
    }

    //Retourne le login
    public function getLogin()
    {
        return $this->login;
    }

    //Retourne le password
    public function getPassword()
    {
        return $this->password;
    }

    //Retourne le rôle
    public function getRole()
    {
        return $this->role;
    }

    //Concaténation du login, du password et du rôle
    public function str(): string
    {
        return "login: " . $this->login . " password: " . $this->password . " role: " . $this->role;
    }

    //Affecte un login, un password et un rôle à un user
    public static function toUser(array $user): User
    {
        return new User($user["login"], $user["password"], $user["role"]);
    }

    //Vérifie si le rôle est moderator
    public function isModerator():bool{
        return $this->role == "moderator";
    }

    //Vérifie si le rôle est publisher
    public function isPublisher():bool{
        return $this->role == "publisher";
    }

    //Vérifie si le rôle est anonymous
    public function isAnonymous():bool
    {
        return $this->role == "anonymous";
    }
    public function isOwner($login):bool
    {
        return $this->login == $login;
    }

}
