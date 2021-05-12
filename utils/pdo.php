<?php
function dbConnect()
{
    try {
        return new PDO(
            $_ENV['DB_CONNECTION'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS'],
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}