<?php

namespace Blog\Controller;

class Controller
{
    protected array $errorMessages = [];

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