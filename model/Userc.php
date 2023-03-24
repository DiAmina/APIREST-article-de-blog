<?php
namespace model;

class Userc
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

    public function str()
    {
        return "login: " . $this->login . " password: " . $this->password . " role: " . $this->role;
    }
}
