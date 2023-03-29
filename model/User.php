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

    //Récupère le login
    public function getLogin()
    {
        return $this->login;
    }

    //Récupère le password
    public function getPassword()
    {
        return $this->password;
    }

    //Récupère le rôle
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

    //Affecte le rôle moderator
    public function isModerator():bool{
        return $this->role == "moderator";
    }

    //Affecte le rôle publisher
    public function isPublisher():bool{
        return $this->role == "publisher";
    }

    //Affecte le rôle anonymous
    public function isAnonymous():bool
    {
        return $this->role == "anonymous";
    }

}
