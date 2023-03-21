<?php

class ConnBD {
    private $host = ["localhost"];
    private $dbname =["gestionarticle_rest"];
    private $username = [""];
    private $password = ["root"];
    private $charset;
    private $dsn;
    private $pdo;

    public function con($host, $dbname, $username, $password, $charset = 'utf8') {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        $this->charset = $charset;

        $this->dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        $this->pdo = new PDO($this->dsn, $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
?>