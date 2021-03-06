<?php

namespace Blog\Controller;

class ErrorController extends Controller
{
    protected string $template = 'default';
    protected string $pageTitle = 'Mon Blog';
    protected string $errorTitle;
    protected string $errorMessage;

    public function __construct($errorTitle = 'Erreur', $errorMessage = 'Une erreur inattendue est survenue')
    {
        $this->setErrorTitle($errorTitle);
        $this->setTitle($errorTitle);
        $this->setErrorMessage($errorMessage);
        parent::__construct();
    }

    public function setTitle($title): Controller
    {
        $this->pageTitle = parent::getPageTitle() . ' : ' . $title;
        return $this;
    }

    public function getErrorTitle(): string
    {
        return $this->errorTitle;
    }

    public function setErrorTitle(string $errorTitle): ErrorController
    {
        $this->errorTitle = $errorTitle;
        return $this;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function setErrorMessage(string $errorMessage): ErrorController
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    public function error(): string
    {
        return $this->render('pages/error.html.twig', [
            'pageTitle' => $this->getPageTitle(),
            'errorTitle' => $this->getErrorTitle(),
            'errorMessage' => $this->getErrorMessage(),
        ]);
    }
}
