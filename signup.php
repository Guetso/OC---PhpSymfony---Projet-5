<?php
require('config.php');
require('model.php');

$pageTitle = 'Inscription';
$errorMessage = null;

if (!isset($_POST['pseudo'])
    or !isset($_POST['email'])
    or !isset($_POST['password'])
    or !isset($_POST['passwordConfirm'])) {
    $errorMessage = 'Il faut renseigner tous les champs !';
}


// $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);

require('templates/signup.php');