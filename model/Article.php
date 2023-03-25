<?php
namespace model;

require_once (__DIR__ . "/User.php");

class Article
{
    private  $id;
    private $auteur;
    private $datePub;
    private $contenu;
    private $login;

    public function __construct($id, $auteur, $datePub, $contenu, $login){
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

    /**
     * Vérifie si l'utilisateur est l'auteur de l'article
     * @param User $auteur
     * @param Article $article
     * @return bool
     */
    public static function isAuteur(User $auteur, Article $article): bool
    {
        return $auteur->getLogin() == $article->getLogin();
    }
}
