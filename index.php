<?php
require('controller/controller.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'welcome') {
        welcomePage();
    }
    elseif ($_GET['action'] == 'signup') {
        signupPage();
    }
    elseif ($_GET['action'] == 'login') {
        loginPage();
    }
    elseif ($_GET['action'] == 'posts') {
        listPostsPage();
    }
    elseif ($_GET['action'] == 'post') {
        if (!isset($_GET['post'])) {
            $errorTitle = 'Erreur';
            $errorMessage = 'Erreur dans la requête !';
            require 'utils/error.php';
            die;
        } else {
            $_GET['post'] = (int)$_GET['post'];
            postPage();
        }
    }
}
else {
    welcomePage();
}
