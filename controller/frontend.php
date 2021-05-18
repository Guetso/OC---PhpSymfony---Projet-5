<?php

use Hugo\Blog\Model\AuthManager;
use Hugo\Blog\Model\PostManager;

require_once ('model/PostManager.php');
require_once ('model/AuthManager.php');

function welcomePage()
{
    require('view/pages/welcome.php');
}

function signupPage()
{
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
                $authManager = new AuthManager();
                $authManager->signup($_POST['pseudo'], $pass_hache, $_POST['email']);
                try {
                    $getLogin = $authManager->getLogin($_POST['pseudo'], $_POST['password']);
                    login($getLogin['id'], $getLogin['pseudo']);
                    header('Location: ?action=welcome');
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
    require('view/pages/signup.php');
}

function loginPage()
{
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
                $authManager = new AuthManager();
                $getLogin = $authManager->getLogin($_POST['pseudo'], $_POST['password']);
                login($getLogin['id'], $getLogin['pseudo']);
                header('Location: ?action=welcome');
            } catch (Exception $e) {
                $errorMessages['generic']['confirmError'] = $e->getMessage();
            }
        }
    }

    if (isset($_GET['logout'])) {
        logout();
        header('Location: ?action=welcome');
    }
    require('view/pages/login.php');
}

function listPostsPage()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();

    require('view/pages/posts.php');
}

function postPage()
{
    $postManager = new PostManager();
    $post = $postManager->getOnePost($_GET['post']);

    if (!$post) {
        $errorTitle = 'Pas de billet';
        $errorMessage = 'Ce billet n\'existe pas';
        require 'utils/error.php';
        die;
    }

    $id_post = $post['id'];
    $titre = $post['title'];
    $contenu = $post['content'];
    $date = $post['date'];
    $time = $post['time'];
    $pageTitle = htmlspecialchars($titre);
    $postTitle = htmlspecialchars($titre) . ' le ' . htmlspecialchars($date) . ' à ' . htmlspecialchars($time);
    $postContent = htmlspecialchars($contenu);
    $commentsPerPage = 5;

    require('./view/pages/post.php');
    require './controller/comments.php';
}
