<?php
namespace model;

class User
{
    private $login;
    private $password;
    private $role;

    public function __construct($login, $password, $role)
    {


        $this->login = $login;
        $this->password = $password;
        $this->role = $role;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function str(): string
    {
        return "login: " . $this->login . " password: " . $this->password . " role: " . $this->role;
    }

    public static function toUser(array $user): User
    {
        return new User($user["login"], $user["password"], $user["role"]);
    }

    public function isModerator():bool{
        return $this->role == "moderator";
    }
    public function isPublisher():bool{
        return $this->role == "publisher";
    }
    public function isAnonymous():bool
    {
        return $this->role == "anonynous";
    }

}
