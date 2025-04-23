<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PdoService
{
    protected $pdo;

    public function __construct()
    {
        $host = 'localhost';
        $db   = 'employeeregister';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            show_error('Database connection failed: ' . $e->getMessage());
        }
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}
