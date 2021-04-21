<?php
require('model.php');

$posts = getPosts();
$pageTitle = 'Mon super blog !';

require('templates/index.php');
