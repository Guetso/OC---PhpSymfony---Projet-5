<?php

namespace Blog\Controller\Admin;

class HomeController extends AdminController
{
    public function displayHome(): string
    {
        return $this->render('pages/admin/home.html.twig', [
            'pageTitle' => $this->getPageTitle(),
        ]);
    }
}
