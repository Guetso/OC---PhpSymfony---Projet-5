<?php
require('./utils/pdo.php');

function getPosts() {
    $bdd = dbConnect();
    $stmt = $bdd->query(
        'SELECT id, title, content, DATE_FORMAT(created_at, \'%d/%m/%Y\') AS date,
      DATE_FORMAT(created_at, \'%Hh%imin%ss\') AS time
      FROM posts ORDER BY created_at DESC LIMIT 0, 10');
    $req = $stmt ->fetchAll();
    $stmt->closeCursor();

    return $req;
}

function getOnePost($id) {
    $bdd = dbConnect();
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

function getPostComments($id_post, $commentsPerPage, $offset) {
    $bdd = dbConnect();
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
    $bdd = dbConnect();
    $stmt = $bdd->prepare('SELECT COUNT(*) AS nb_comments FROM comments WHERE post_id = ?');
    $stmt->execute(array($id_post));
    $req = $stmt->fetch()['nb_comments'];
    $stmt->closeCursor();
    return $req;
}