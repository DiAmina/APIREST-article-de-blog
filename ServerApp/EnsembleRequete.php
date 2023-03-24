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
        //SUPPRIMER LE NOMBRE DE LIKE ET DE DISLIKE D'un article donnée puis le supprimer
        $sql = "DELETE FROM article WHERE id=$id";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt) {
            return $stmt->execute(array());
        }
    }
    
    //pas fini: en gros si le le login est === à login qui a mis le like alors on peut supprimer le like
    public function deleteLike($login,$id) {
        $sql = "DELETE FROM tablelike WHERE login=:login AND id=:id";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array(':login'=>$login,'id' =>$id))){
            return $this->pdo->lastInsertId();
        }else{
            return false;
        }
    }

    //pas fini: en gros si le le login est === à login qui a mis le dislike alors on peut supprimer le dislike
    public function deleteDisLike($login,$id) {
        $sql = "DELETE FROM tabledislike  WHERE login=:login AND id=:id";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array(':login' =>$login,':id' =>$id))){
            return $this->pdo->lastInsertId();
        }else{
            return false;
        }
    }
    

    public function like($login,$id) {
        $sql = "INSERT INTO tablelike (login,id) VALUES (:login,:id)";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array(':login' =>$login,':id' =>$id))){
            return $this->pdo->lastInsertId();
        }else{
            return false;
        }
    }

    public function dislike($login,$id) {
        $sql = "INSERT INTO tabledislike (login,id) VALUES (:login,:id)";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array(':login' =>$login,':id' =>$id))){
            return $this->pdo->lastInsertId();
        }else{
            return false;
        }
    }

    public function getLike($id) {
        $sql = "SELECT COUNT(*) FROM tablelike WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getDisLike($id) {
        $sql = "SELECT COUNT(*) FROM tabledislike WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getLikeUser($login,$id) {
        $sql = "SELECT COUNT(*) FROM tablelike WHERE login = :login AND id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(':login' => $login,':id' => $id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getDisLikeUser($login,$id) {
        $sql = "SELECT COUNT(*) FROM tabledislike WHERE login = :login AND id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(':login' => $login,':id' => $id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    //si le login === à celui sui la posté il peut faire une put
    public function putContenu($login,$id,$contenu) {
        $sql = "UPDATE article SET contenu =:contenu WHERE login=:login AND id=:id";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array(':login' =>$login,':id' =>$id,':contenu' =>$contenu))){
            return $this->pdo->lastInsertId();
        }else{
            return false;
        }
    }

    //si le role === a publisher il peut faire un post
    public function postArticle($login,$contenu) {
        $sql = "INSERT INTO article (login,contenu) VALUES (:login,:contenu)";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array(':login' =>$login,':contenu' =>$contenu))){
            return $this->pdo->lastInsertId();
        }else{
            return false;
        }
    }

}
   
?>