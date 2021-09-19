<?php

namespace Blog\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    protected Environment $twig;
    protected string $template;
    protected string $pageTitle;
    protected array $infoMessages = [];

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../view');
        $this->twig   = new Environment($loader, []); //TODO Set cache option
    }

    public function render($view, $variables = []): string
    {
        return $this->twig->render($view, $variables); //TODO Voir pourquoi unhandled
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function setTemplate(string $template): Controller
    {
        $this->template = $template;
        return $this;
    }

    public function getPageTitle(): string
    {
        return $this->pageTitle;
    }

    public function setPageTitle(string $title): Controller
    {
        $this->pageTitle = $title;
        return $this;
    }

    public function getInfoMessages(): array
    {
        return $this->infoMessages;
    }

    public function setInfoMessages(string $infoMessages): Controller
    {
        $this->infoMessages[] = $infoMessages;
        return $this;
    }
}
