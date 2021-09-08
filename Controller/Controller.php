<?php

namespace Blog\Controller;

class Controller
{
    protected string $template = 'default';
    protected string $title = 'Mon Blog';
    protected string $viewPath = __DIR__ . '/../' . 'view/';
    protected array $errorMessages = [];

    //todo : changer $errorMessages par $infoMessages

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

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle($title): Controller
    {
        $this->title = $title;
        return $this;
    }

    public function getErrorMessages(): array
    {
        return $this->errorMessages;
    }

    public function setErrorMessages(string $errorMessages): Controller
    {
        $this->errorMessages[] = $errorMessages;
        return $this;
    }

}