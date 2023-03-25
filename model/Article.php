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

    //Créer un id, un auteur, une date de publication, un contenu et un login
    public function __construct($id, $auteur, $datePub, $contenu, $login){
        $this->id = $id;
        $this->auteur = $auteur;
        $this->datePub = $datePub;
        $this->contenu = $contenu;
        $this->login = $login;
    }

    //Récupère l'id
    public function getId(){
        return $this->id;
    }

    //Récupère l'auteur
    public function getAuteur(){
        return $this->auteur;
    }

    //récupère la date de publication
    public function getDatePub(){
        return $this->datePub;
    }

    //récupère le contenu
    public function getContenu(){
        return $this->contenu;
    }

    //récupère le login
    public function getLogin(){
        return $this->login;
    }

    //Concatène les informations de l'article
    public function str(){
        return "id: ".$this->id." auteur: ".$this->auteur." datePub: ".$this->datePub." contenu: ".$this->contenu;
    }

    //Assignation de la valeur du contenu
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
