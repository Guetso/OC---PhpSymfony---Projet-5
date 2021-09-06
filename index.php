<?php

use Blog\Controller\LoginController;
use Blog\Controller\HomeController;
use Blog\Controller\SignupController;
use Blog\Controller\LogoutController;

require('Controller/frontend.php');
require_once('utils/config.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'welcome') {
            $homeController = new HomeController();
            $homeController->home();
        } elseif ($_GET['action'] == 'signup') {
            $signupController = new SignupController();
            $signupController->signup();
        } elseif ($_GET['action'] == 'login') {
            $loginController = new LoginController();
            $loginController->login();
        } elseif ($_GET['action'] == 'logout') {
            $logoutController = new LogoutController();
            $logoutController->logout();
        } elseif ($_GET['action'] == 'posts') {
            listPostsPage();
        } elseif ($_GET['action'] == 'post') {
            if (isset($_GET['post']) && $_GET['post'] > 0) {
                $_GET['post'] = (int)$_GET['post'];
                postPage();
            } else {
                throw new Exception('Erreur lors de récupération de l\'article !');
            }
        } else {
            $errorTitle   = 'Erreur 404';
            $errorMessage = 'Cette page n\'existe pas';
            require 'utils/error.php';
            die;
        }
    } else {
        $homeController = new HomeController();
        $homeController->home();
    }
} catch (Exception $e) {
    $errorTitle   = 'Erreur';
    $errorMessage = $e->getMessage();
    require 'utils/error.php';
    die;
}

