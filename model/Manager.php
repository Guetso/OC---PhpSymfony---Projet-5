<?php
namespace Hugo\Blog\Model;

use PDO;

class Manager {
    protected function dbConnect()
    {
        return new PDO(
            $_ENV['DB_CONNECTION'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS'],
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    }
}