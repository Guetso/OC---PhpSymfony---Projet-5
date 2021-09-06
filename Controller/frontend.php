<?php

use Blog\Manager\AuthManager;
use Blog\Manager\PostManager;

function listPostsPage()
{
    $postManager = new PostManager();
    $posts       = $postManager->getPosts();

    require('view/pages/posts.php');
}

function postPage()
{
    $postManager = new PostManager();
    $post        = $postManager->getOnePost($_GET['post']);

    if (!$post) {
        $errorTitle   = 'Pas de billet';
        $errorMessage = 'Ce billet n\'existe pas';
        require 'utils/error.php';
        die;
    }

    $id_post         = $post['id'];
    $updatedDate     = htmlspecialchars($post['updatedDate']);
    $updatedTime     = htmlspecialchars($post['updatedTime']);
    $updatedDateTime = 'le ' . $updatedDate . 'à ' . $updatedTime;
    $postAuthor      = htmlspecialchars($post['author']);
    $postTitle       = htmlspecialchars($post['title']);
    $postChapo       = htmlspecialchars($post['subtitle']);
    $postContent     = htmlspecialchars($post['content']);
    $commentsPerPage = 5;

    require('./view/pages/post.php');
    require './Controller/comments.php';
}
