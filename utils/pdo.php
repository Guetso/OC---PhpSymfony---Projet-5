<?php
function dbConnect() {
    try {
        return new PDO('mysql:host=localhost;dbname=myblog;charset=utf8', 'guetso', 'polo2068');
    }
    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }
}