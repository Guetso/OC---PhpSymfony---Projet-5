<?php
require('config.php');
require('model.php');

$posts = getPosts();
$pageTitle = 'Mon super blog !';

require('templates/posts.php');

/* Change index */
