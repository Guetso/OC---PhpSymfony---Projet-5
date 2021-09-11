<?php

namespace Blog\Controller;

class Controller
{
    protected string $template = 'default';
    protected string $pageTitle = 'Mon Blog';
    protected string $viewPath = __DIR__ . '/../' . 'view/';
    protected array $infoMessages = [];

    public function render($view, $variables = [], $components = [])
    {
        ob_start();
        extract($variables);
        require($this->viewPath . "" . str_replace('.', '/', $view) . ".php");
        if (!empty($components)) {
            foreach ($components as $component) {
                extract($component['variables']);
                require($this->viewPath . "" . str_replace('.', '/', $component['view']) . ".php");
            }
        }
        $content = ob_get_clean();
        require($this->viewPath . "/templates/" . $this->template . ".php");
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

    public function getViewPath(): string
    {
        return $this->viewPath;
    }

    public function setViewPath(string $viewPath): Controller
    {
        $this->viewPath = $viewPath;
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