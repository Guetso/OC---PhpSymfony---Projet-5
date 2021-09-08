<?php

namespace Blog\Controller;

use Blog\Manager\UserManager;
use Exception;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->setTitle('Connexion');
    }

    public function login()
    {
        if (isset($_POST['controlSubmit'])) {
            $validForm = true;
            if (empty($_POST['pseudo']) || empty($_POST['password'])) {
                $validForm = false;
                $this->setInfoMessages('Il faut renseigner tous les champs !');
            }
            if ($validForm === true) {
                $_POST['pseudo']   = htmlspecialchars($_POST['pseudo']);
                $_POST['password'] = htmlspecialchars($_POST['password']);
                $userManager       = new UserManager();
                try {
                    $login= $userManager->login($_POST['pseudo'], $_POST['password']);
                    setSession($login['id'], $login['pseudo']);
                    header('Location: ?action=welcome');
                } catch (Exception $e) {
                    $this->setInfoMessages($e->getMessage());
                }
            }
        }
        $pageTitle = $this->getTitle();
        $errors    = $this->getInfoMessages();
        $this->render('pages.login', compact('pageTitle', 'errors'));
    }
}