<?php
require('config.php');
require('model.php');

$posts = getPosts();
$pageTitle = 'Mes articles !';

require('templates/posts.php');

/* Change index */
