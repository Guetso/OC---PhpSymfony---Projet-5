<?php


namespace Blog\Controller\App;

class HomeController extends AppController
{
    public function displayHome(): string
    {
        $this->setPageTitle('Bienvenue sur mon Blog ');
        return $this->render('pages/home.html.twig', [
            'pageTitle' => $this->getPageTitle(),
            'errors'    => $this->getInfoMessages(),
            'pseudo'    => $_SESSION['pseudo'] ?? '',
            'isAdmin'    => $_SESSION['isAdmin'] ?? '',
        ]);
    }
}
