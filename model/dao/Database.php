<?php
namespace model\dao;

use PDO;

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
     * @return Database|null
     */
    public static function getInstance(): ?Database
    {
        if (!self::$instance) {
            self::$instance = new Database();
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
