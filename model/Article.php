<?php

class article{
    private  $id;
    private $auteur;
    private $datePub;
    private $contenu;
    private $login;

    public function __construc($id, $auteur, $datePub, $contenu, $login){
        $this->id = $id;
        $this->auteur = $auteur;
        $this->datePub = $datePub;
        $this->contenu = $contenu;
        $this->login = $login;
    }

    public function getId(){
        return $this->id;
    }

    public function getAuteur(){
        return $this->auteur;
    }

    public function getDatePub(){
        return $this->datePub;
    }

    public function getContenu(){
        return $this->contenu;
    }

    public function getLogin(){
        return $this->login;
    }
    public function str(){
        return "id: ".$this->id." auteur: ".$this->auteur." datePub: ".$this->datePub." contenu: ".$this->contenu;
    }

    public function setcontenu($contenu){
        $this->contenu = $contenu;
    }

}
