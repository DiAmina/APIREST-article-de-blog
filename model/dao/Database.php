<?php
namespace model\dao;

/**
 * Class Singleton Database
 * @package model\dao
 */
class Database
{
    private static $instance = null;
    private $connection;

    /**
     * Database constructor.
     */
    private function __construct()
    {
        $this->connection = new PDO("mysql:host=localhost;dbname=gestionarticle_rest;charset=UTF8", "root", "");
    }

    /**
     * Retourne l'instance de la classe
     * @param $login
     * @param $password
     * @return Database|null
     */
    public static function getInstance($login, $password): ?Database
    {
        if (!self::$instance) {
            self::$instance = new Database($login, $password);
        }
        return self::$instance;
    }

    /**
     * Retourne la connexion à la base de données
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
