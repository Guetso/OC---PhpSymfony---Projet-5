<?php


namespace Blog\Controller;


class LogoutController extends Controller
{
    public function logout() {
        $_SESSION = array();
        session_destroy();
        $homeController = new HomeController();
        $homeController->home();
    }
}