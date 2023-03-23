<?php
class User {
    private $username;
    private $password;
    private $role;

    public function main($username, $password,$role) {
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    public function isModerator() {
        return $this->role === 'moderator';
    }

    public function isPublisher(){
        return $this->role ==='publisher';
    }

    public function isUser() {
        return $this->role === 'anonyme';
    }
    
}
?>