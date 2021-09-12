<?php

namespace Blog\Controller;

class Controller
{
    private const VIEWPATH = __DIR__ . '/../' . 'view/';

    protected string $template = 'default';
    protected string $pageTitle = 'Mon Blog';
    protected array $infoMessages = [];

    public function render($view, $variables = [])
    {
        ob_start();
        extract($variables);
        $viewPath = self::VIEWPATH . "" . str_replace('.', '/', $view) . ".php";
        require($viewPath);
        $content = ob_get_clean();
        $templatePath = self::VIEWPATH . "/templates/" . $this->getTemplate() . ".php";
        require($templatePath);
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

    public function setPageTitle($title): Controller
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