<?php


namespace Blog\Controller;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->setTitle('Bienvenue sur mon Blog');
    }

    public function home() {
        $pageTitle = $this->getTitle();
        $loginErrors = $this->getErrorMessages();
        $userName = $_SESSION['pseudo'] ?? '';
        $this->render('pages.home', compact('pageTitle','userName', 'loginErrors'));
    }
}