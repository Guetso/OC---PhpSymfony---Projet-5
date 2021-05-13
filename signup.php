<?php
require('config.php');
require('model.php');

$pageTitle = 'Inscription';
$errorMessages = [
    'generic' => [],
];

if (isset($_POST['controlSubmit'])) {
    $validForm = true;
    if (empty($_POST['pseudo'])
        || empty($_POST['email'])
        || empty($_POST['password'])
        || empty($_POST['passwordConfirm'])) {
        $validForm = false;
        $errorMessages['generic']['empty'] = 'Il faut renseigner tous les champs !';
    }
    if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
        $validForm = false;
        $errorMessages['emailError'] = 'L\'adresse email n\'est pas valide !';
    }
    if (!preg_match("#^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$#",
        $_POST['password'])) {
        $validForm = false;
        $errorMessages['passError'] = 'Le mot de passe n\'est pas valide !';
    }
    if ($_POST['password'] !== $_POST['passwordConfirm']) {
        $validForm = false;
        $errorMessages['confirmError'] = 'La confirmation du mot de passe a échouée !';
    }
    if ($validForm === true) {
        $_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
        $_POST['email'] = htmlspecialchars($_POST['email']);
        $_POST['password'] = htmlspecialchars($_POST['password']);
        $_POST['passwordConfirm'] = htmlspecialchars($_POST['passwordConfirm']);

        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
        try {
            signup($_POST['pseudo'], $pass_hache, $_POST['email']);
            try {
                $getLogin = getLogin($_POST['pseudo'], $_POST['password']);
                login( $getLogin['id'], $getLogin['pseudo']);
                header('Location: index.php');
            } catch (Exception $e) {
                $errorMessages['generic']['confirmError'] = $e->getMessage();
            }
        } catch (Exception $sqlError) {
            $sqlErrorMessages = $sqlError->getMessage();
            if (str_contains($sqlErrorMessages, 'members.pseudo')) {
                $errorMessages['generic']['sqlError'] = 'Ce pseudo est déjà pris !';
            }
            if (str_contains($sqlErrorMessages, 'members.email')) {
                $errorMessages['generic']['sqlError'] = 'Cet email est déjà pris !';
            }
        }
    }
}
require('templates/pages/signup.php');