<?php
    require ('models/post.php');

    $posts = getPosts();
    $pageTitle = 'Mon super blog !';

    require('templates/index.php');
