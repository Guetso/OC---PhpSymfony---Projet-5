<?php

use Blog\Controller\LoginController;

require('controller/frontend.php');
require_once('utils/config.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'welcome') {
            welcomePage();
        } elseif ($_GET['action'] == 'signup') {
            signupPage();
        } elseif ($_GET['action'] == 'login') {
            $loginController = new LoginController();
            $loginController->loginAction();
        } elseif ($_GET['action'] == 'posts') {
            listPostsPage();
        } elseif ($_GET['action'] == 'post') {
            if (isset($_GET['post']) && $_GET['post'] > 0) {
                $_GET['post'] = (int)$_GET['post'];
                postPage();
            } else {
                throw new Exception('Erreur lors de récupération de l\'article !');
            }
        }
        else {
            $errorTitle = 'Erreur 404';
            $errorMessage = 'Cette page n\'existe pas';
            require 'utils/error.php';
            die;
        }
    } else {
        welcomePage();
    }
} catch (Exception $e) {
    $errorTitle = 'Erreur';
    $errorMessage = $e->getMessage();
    require 'utils/error.php';
    die;
}

