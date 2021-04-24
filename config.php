<?php
require 'vendor/autoload.php';
require 'utils/rootPath.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();