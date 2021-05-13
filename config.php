<?php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function login($id, $pseudo) {
    $_SESSION['connected'] = true;
    $_SESSION['id'] = $id;
    $_SESSION['pseudo'] = $pseudo;
}

function logout()
{
    $_SESSION = array();
    session_destroy();
}

$style = './public/style.css';