<?php

use Blog\Controller\Admin\HomeController;
use Blog\Controller\Admin\PostController;
use Blog\Controller\ErrorController;

require_once('../utils/config.php');

try {
    if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'welcome':
                    $homeController = new HomeController();
                    echo $homeController->displayHome();
                    break;
                case 'posts':
                    $postController = new PostController();
                    echo $postController->displayPosts();
                    break;
                case 'post':
                    $postController = new PostController();
                    echo $postController->displayPost();
                    break;
                case 'post.add':
                    $postController = new PostController();
                    echo $postController->addPost();
                    break;
                case 'post.delete':
                    $postController = new PostController();
                    $postController->deletePost();
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
    } else {
        $errorTitle      = 'Erreur 401';
        $errorMessage    = 'Unauthorized';
        $errorController = new ErrorController($errorTitle, $errorMessage);
        echo $errorController->error();
        die;
    }
} catch (Exception $e) {
    $errorTitle      = 'Erreur';
    $errorMessage    = $e->getMessage();
    $errorController = new ErrorController($errorTitle, $errorMessage);
    echo $errorController->error();
    die;
}
