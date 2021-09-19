<?php

use Blog\Controller\App\HomeController;
use Blog\Controller\App\UserController;
use Blog\Controller\App\PostController;
use Blog\Controller\ErrorController;

require_once('utils/config.php');

try {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'welcome':
                $homeController = new HomeController();
                echo $homeController->displayHome();
                break;
            case 'signup':
                $signupController = new UserController();
                echo $signupController->signup();
                break;
            case 'login':
                $loginController = new UserController();
                echo $loginController->login();
                break;

            case 'logout':
                $logoutController = new UserController();
                $logoutController->logout();
                break;
            case 'posts':
                $postsController = new PostController();
                echo $postsController->displayPosts();
                break;
            case 'post':
                $postController = new PostController();
                echo $postController->displayPost();
                break;
            default:
                $errorTitle      = 'Erreur 404';
                $errorMessage    = 'Cette page n\'existe pas.';
                $errorController = new ErrorController($errorTitle, $errorMessage);
                echo $errorController->error();
                die;
        }
    } else {
        $homeController = new HomeController();
        echo $homeController->displayHome(); //TODO pourquoi echo ici et ci dessous et pas dans le postController
    }
} catch (Exception $e) {
    $errorTitle      = 'Erreur';
    $errorMessage    = $e->getMessage();
    $errorController = new ErrorController($errorTitle, $errorMessage);
    echo $errorController->error();
    die;
}
