<?php
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $pageNbr = (int)($_GET['page']);
} else {
    $pageNbr = 1;
}
if ($pageNbr === 0) {
    $pageNbr = 1;
}

$offset = ($pageNbr - 1) * $commentsPerPage;

$comments = getPostComments($id_post, $commentsPerPage,$offset  );
$comments_nb = getCommentsNb($id_post);
$pageCommentNb = ceil($comments_nb / $commentsPerPage);

if (isset($_GET['page']) && $_GET['page'] > $pageCommentNb) {
    $errorTitle = 'Erreur';
    $errorMessage = 'Cette page n\'existe pas !';
    include './error.php';
    die;
}

require('templates/comments.php');