<?php

use Blog\Controller\LoginController;
use Blog\Controller\HomeController;
use Blog\Controller\SignupController;
use Blog\Controller\LogoutController;
use Blog\Controller\PostsController;
use Blog\Controller\PostController;
use Blog\Controller\ErrorController;

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
            $postsController = new PostsController();
            $postsController->posts();
        } elseif ($_GET['action'] == 'post') {
            $postController = new PostController();
            $postController->post();
        } else {
            $errorTitle   = 'Erreur 404';
            $errorMessage = 'Cette page n\'existe pas.';
            $errorController = new ErrorController($errorTitle, $errorMessage);
            $errorController->error();
            die;
        }
    } else {
        $homeController = new HomeController();
        $homeController->home();
    }
} catch (Exception $e) {
    $errorTitle   = 'Erreur';
    $errorMessage = $e->getMessage();
    $errorController = new ErrorController($errorTitle, $errorMessage);
    $errorController->error();
    die;
}

