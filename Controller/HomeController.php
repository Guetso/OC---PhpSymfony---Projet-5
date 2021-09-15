<?php


namespace Blog\Controller;

class HomeController extends Controller
{
    public function displayHome(): string
    {
        $this->setPageTitle('Bienvenue sur mon Blog ');
        return $this->render('pages/home.html.twig', [
            'pageTitle' => $this->getPageTitle(),
            'errors' => $this->getInfoMessages(),
            'pseudo' =>  $_SESSION['pseudo'] ?? '',
        ]);
    }
}
