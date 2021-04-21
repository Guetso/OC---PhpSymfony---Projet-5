<?php

function getPosts() {
    try {
        $bdd = new PDO(
            'mysql:host=localhost;dbname=myblog;charset=utf8',
            'guetso',
            'polo2068',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $stmt = $bdd->query(
        'SELECT id, title, content, DATE_FORMAT(created_at, \'%d/%m/%Y\') AS date,
      DATE_FORMAT(created_at, \'%Hh%imin%ss\') AS time
      FROM posts ORDER BY created_at DESC LIMIT 0, 10');
    $req = $stmt ->fetchAll();
    $stmt->closeCursor();

    return $req;
}

function getOnePost($id) {
    try {
        $bdd = new PDO(
            'mysql:host=localhost;dbname=myblog;charset=utf8',
            'guetso',
            'polo2068',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $stmt = $bdd->prepare(
        'SELECT id, title, content, 
        DATE_FORMAT(created_at, \'%d/%m/%Y\') AS date,
        DATE_FORMAT(created_at, \'%Hh%imin%ss\') AS time 
    FROM posts 
    WHERE id = ?'
    );
    $stmt->execute(array($id));
    $req = $stmt->fetch();
    $stmt->closeCursor();

    return $req;
}