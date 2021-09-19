<?php

namespace Blog\Controller\Admin;

use Blog\Controller\Controller;

abstract class AdminController extends Controller
{
    protected string $template = 'admin';
    protected string $pageTitle = 'Espace admin';
}
