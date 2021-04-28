<?php
require('config.php');
require('model.php');

$posts = getPosts();
$pageTitle = 'Mes articles !';

require('templates/pages/posts.php');

/* Change index */
