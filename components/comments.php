<?php
if (isset($_GET['page']) && $_GET['page'] > $pageCommentNb) {
    $errorTitle = 'Erreur';
    $errorMessage = 'Cette page n\'existe pas !';
    include '../pages/error.php';
    die;
}

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $pageNbr = (int)($_GET['page']);
} else {
    $pageNbr = 1;
}
if ($pageNbr === 0) {
    $pageNbr = 1;
}

$offset = ($pageNbr - 1) * $commentsPerPage;

require ('../models/comment.php');

$comments = getPostComments($id_post, $commentsPerPage,$offset  );
$comments_nb = getCommentsNb($id_post);
$pageCommentNb = ceil($comments_nb / $commentsPerPage);

require('../templates/comments.php');