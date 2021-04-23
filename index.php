<?php
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require('model.php');

$posts = getPosts();
$pageTitle = 'Mon super blog !';

require('templates/index.php');
