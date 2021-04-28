<?php
require('config.php');
require('model.php');

$pageTitle = 'Inscription';
$errorMessage = null;

if (isset($_POST['controlSubmit'])) {
    if (empty($_POST['pseudo'])
        or empty($_POST['email'])
        or empty($_POST['password'])
        or empty($_POST['passwordConfirm'])) {
        $errorMessage = 'Il faut renseigner tous les champs !';
    }
// MYSQL
    //REDIRECTION
    header('Location: index.php');
}


// $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);

require('templates/pages/signup.php');