<?php
require('config.php');
require('model.php');

$pageTitle = 'Connexion';
$errorMessages = [
    'generic' => [],
];

if (isset($_POST['controlSubmit'])) {
    $validForm = true;
    if (empty($_POST['pseudo']) || empty($_POST['password'])) {
        $validForm = false;
        $errorMessages['generic']['empty'] = 'Il faut renseigner tous les champs !';
    }
    if ($validForm === true) {
        $_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
        $_POST['password'] = htmlspecialchars($_POST['password']);
        try {
            $login = login($_POST['pseudo'], $_POST['password']);
            $_SESSION['id'] = $login['id'];
            $_SESSION['pseudo'] = $login['pseudo'];
            header('Location: index.php');
        } catch (Exception $e) {
            $errorMessages['generic']['confirmError'] = $e->getMessage();
        }
    }
}

if ( isset($_GET['logout'])) {
    logout();
    header('Location: index.php');
}
require('templates/pages/login.php');