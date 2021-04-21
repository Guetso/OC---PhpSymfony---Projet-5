<?php
require ('../models/post.php');

$post = getOnePost($_GET['post']);

if (!$post) {
    $errorTitle = 'Pas de billet';
    $errorMessage = 'Ce billet n\'existe pas';
    include '../pages/error.php';
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

require('../templates/post.php');