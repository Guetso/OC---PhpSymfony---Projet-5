<?php
namespace Blog\Manager;

use PDO;

class Manager {
    protected function dbConnect(): PDO
    {
        return new PDO(
            $_ENV['DB_CONNECTION'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS'],
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    }
}