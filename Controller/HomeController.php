<?php


namespace Blog\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->setPageTitle('Bienvenue sur mon Blog');
    }

    public function displayHome()
    {
        $pageTitle   = $this->getPageTitle();
        $loginErrors = $this->getInfoMessages();
        $userName    = $_SESSION['pseudo'] ?? '';
        $this->render('pages.home', compact('pageTitle', 'userName', 'loginErrors'));
    }
}
