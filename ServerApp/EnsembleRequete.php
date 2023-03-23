<?php

class EnsembleRequete {

    private $pdo;

    public function con($host, $username,$database, $password) {
        $this->pdo = new PDO("mysql:host=localhost;dbname=gestionarticle_rest;charset=UTF8",'root','');
    }

    public function get($id) {
        $sql = "SELECT * FROM article WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public function getAll() {
        $sql = "SELECT * FROM article ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array());
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function post($data) { 
        $stmt = $this->pdo->prepare("INSERT INTO article (contenu) VALUES (:contenu)");
        if($stmt->execute(array(':contenu' => $data['contenu']))) {
            return $this->pdo->lastInsertId();
        }else{
            return false;
        }
    }

    public function put($id,$phrase) {
        $sql = "UPDATE article SET contenu =:contenu WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array(':id' =>$id,':contenu' => $phrase))){
            return $this->pdo->lastInsertId();
        }else{
            return false;
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM article WHERE id=$id";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt) {
            return $stmt->execute(array());
        }
    }

   /* public function last5phrases($chuckn_facts) {
        $sql = "SELECT * FROM chuckn_facts ORDER BY DESC LIMIT 5";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(':phrase' => $data));
        $resultData = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultData;
    }

    public function signalphrases($chuckn_facts){
        $sql = "SELECT phrase FROM chuckn_facts WHERE signalement > 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(':phrase'=>$data));
        $resultData = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultData;
    }
    */
}
   
?>