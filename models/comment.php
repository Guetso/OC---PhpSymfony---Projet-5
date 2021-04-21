<?php

function getPostComments($id_post, $commentsPerPage, $offset) {
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
        'SELECT post_id, author, content,
   DATE_FORMAT(created_at, \'%d/%m/%Y\') AS date,
   DATE_FORMAT(created_at, \'%Hh%imin%ss\') AS time
   FROM comments
   WHERE post_id = ?
   LIMIT ? OFFSET ?'
    );
    $stmt->bindParam(1, $id_post, PDO::PARAM_INT);
    $stmt->bindParam(2, $commentsPerPage, PDO::PARAM_INT);
    $stmt->bindParam(3, $offset, PDO::PARAM_INT);
    $stmt->execute();
    $req = $stmt->fetchAll();
    $stmt->closeCursor();
    return $req;
}

function getCommentsNb($id_post) {
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
    $stmt = $bdd->prepare('SELECT COUNT(*) AS nb_comments FROM comments WHERE post_id = ?');
    $stmt->execute(array($id_post));
    $req = $stmt->fetch()['nb_comments'];
    $stmt->closeCursor();
    return $req;
}