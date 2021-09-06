<?php

use Blog\Manager\CommentManager;

require_once('Manager/CommentManager.php');

/** @var integer $commentsPerPage */
/** @var integer $id_post */

if ((isset($_GET['page'])) && (!empty($_GET['page'])) && ($_GET['page'] > 0)) {
    $pageNbr = (int)($_GET['page']);
} else {
    $pageNbr = 1;
}

$offset = ($pageNbr - 1) * $commentsPerPage;

$commentManager = new CommentManager();

$comments = $commentManager->getPostComments($id_post, $commentsPerPage, $offset);
$comments_nb = $commentManager->getCommentsNb($id_post);
$pageCommentNb = ceil($comments_nb / $commentsPerPage);

if (isset($_GET['page']) && $_GET['page'] > $pageCommentNb) {
    $errorTitle = 'Erreur';
    $errorMessage = 'Cette page n\'existe pas !';
    require 'utils/error.php';
    die;
}

if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {
    require './Controller/commentsForm.php';
}

require('view/components/comments.php');