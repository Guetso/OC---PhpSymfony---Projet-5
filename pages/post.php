<?php
if (!isset($_GET['post'])) {
    $errorTitle = 'Erreur';
    $errorMessage = 'Erreur dans la requête !';
    include '../pages/error.php';
    die;
} else {
    $_GET['post'] = (int) $_GET['post'];
}

require('../components/post.php');
