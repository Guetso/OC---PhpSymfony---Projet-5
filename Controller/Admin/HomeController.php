<?php

namespace Blog\Controller\Admin;

use Blog\Controller\Controller;
use Blog\Controller\ErrorController;

class HomeController extends Controller
{
    public function displayHome(): string
    {
        $this->setPageTitle('Bienvenue sur l\'espace administration ');
        return $this->render('pages/admin/home.html.twig', [
            'pageTitle' => $this->getPageTitle(),
            'errors'    => $this->getInfoMessages(),
            'pseudo'    => $_SESSION['pseudo'] ?? '',
        ]);
    }
}
