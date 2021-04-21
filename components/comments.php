<?php
if (isset($_GET['page']) && $_GET['page'] > $pageCommentNb) {
    $errorTitle = 'Erreur';
    $errorMessage = 'Cette page n\'existe pas !';
    include '../pages/error.php';
    die;
}

require('../templates/comments.php');