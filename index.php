<?php
    require ('models/post.php');

    $posts = getPosts();

    require('templates/index.php');
