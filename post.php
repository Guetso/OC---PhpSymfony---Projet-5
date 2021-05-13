<?php
require('config.php');
require('model.php');

if (!isset($_GET['post'])) {
    $errorTitle = 'Erreur';
    $errorMessage = 'Erreur dans la requête !';
    require 'error.php';
    die;
} else {
    $_GET['post'] = (int) $_GET['post'];
}

$post = getOnePost($_GET['post']);

if (!$post) {
    $errorTitle = 'Pas de billet';
    $errorMessage = 'Ce billet n\'existe pas';
    require 'error.php';
    die;
}

$id_post = $post['id'];
$titre = $post['title'];
$contenu = $post['content'];
$date = $post['date'];
$time = $post['time'];
$pageTitle = htmlspecialchars($titre);
$postTitle = htmlspecialchars($titre) . ' le ' . htmlspecialchars($date) . ' à ' . htmlspecialchars($time);
$postContent = htmlspecialchars($contenu);
$commentsPerPage = 5;

require('./templates/pages/post.php');
