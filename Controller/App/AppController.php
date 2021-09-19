<?php

namespace Blog\Controller\App;

use Blog\Controller\Controller;

abstract class AppController extends Controller
{
    protected string $template = 'default';
    protected string $pageTitle = 'Mon Blog';
}
