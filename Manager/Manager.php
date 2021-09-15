<?php

namespace Blog\Manager;

use PDO;

abstract class Manager
{
    protected function dbConnect($fetchMode = null): PDO
    {
        $PDO = new PDO(
            $_ENV['DB_CONNECTION'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS'],
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
        if ($fetchMode) {
            $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $fetchMode);
        }
        return $PDO;
    }
}
