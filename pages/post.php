<?php
if (!isset($_GET['post'])) {
    $errorTitle = 'Erreur';
    $errorMessage = 'Erreur dans la requête !';
    include '../pages/error.php';
    die;
}

$_GET['post'] = (int) $_GET['post'];

include '../utils/pdo.php';

$stmt = $bdd->prepare(
    'SELECT id, titre, contenu, 
   DATE_FORMAT(date_creation, "%d/%m/%Y") AS date,
   DATE_FORMAT(date_creation, "%Hh%imin%ss") AS time 
   FROM billets 
   WHERE id = ?'
);
$stmt->execute(array($_GET['post']));
$post = $stmt->fetch();

if (!$post) {
    $errorTitle = 'Pas de billet';
    $errorMessage = 'Ce billet n\'existe pas';
    include '../pages/error.php';
    die;
}

$id_post = $post['id'];
$titre = $post['titre'];
$contenu = $post['contenu'];
$date = $post['date'];
$time = $post['time'];
$stmt->closeCursor();

if (isset($_GET['page']) && !empty($_GET['page'])){
    $pageNbr = (int) ($_GET['page']);
} else {
    $pageNbr = 1;
}
if ($pageNbr === 0) {
    $pageNbr = 1;
}

$commentsPerPage = 5;
$offset = ($pageNbr - 1) * $commentsPerPage;

$stmt = $bdd->prepare(
    'SELECT id_billet, auteur, commentaire,
   DATE_FORMAT(date_commentaire, "%d/%m/%Y") AS date,
   DATE_FORMAT(date_commentaire, "%Hh%imin%ss") AS time
   FROM commentaires
   WHERE id_billet = ?
   LIMIT ? OFFSET ?'
);
$stmt->bindParam(1, $id_post, PDO::PARAM_INT);
$stmt->bindParam(2, $commentsPerPage, PDO::PARAM_INT);
$stmt->bindParam(3, $offset, PDO::PARAM_INT);
$stmt->execute();
$comments = $stmt ->fetchAll();
$stmt->closeCursor();

$stmt = $bdd->prepare('SELECT COUNT(*) AS nb_comments FROM commentaires WHERE id_billet = ?');
$stmt->execute(array($_GET['post']));
$comments_nb = $stmt->fetch()['nb_comments'];
$stmt->closeCursor();
$pageCommentNb = ceil($comments_nb/$commentsPerPage);

include '../components/billet.php';
