<?php

namespace Blog\Controller;

use Blog\Manager\AuthManager;

class LoginController extends Controller
{
    public function loginAction()
    {
        if (isset($_POST['controlSubmit'])) {
            $validForm = true;
            if (empty($_POST['pseudo']) || empty($_POST['password'])) {
                $validForm = false;
                $this->setErrorMessages('Il faut renseigner tous les champs !');
            }
            if ($validForm === true) {
                $_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
                $_POST['password'] = htmlspecialchars($_POST['password']);
                $authManager = new AuthManager();
                try {
                    $getLogin = $authManager->getLogin($_POST['pseudo'], $_POST['password']);
                    login($getLogin['id'], $getLogin['pseudo']);
                    header('Location: ?action=welcome');
                } catch (\Exception $e) {
                    $this->setErrorMessages($e->getMessage());
                }
            }
        }
        $loginErrors = $this->getErrorMessages();
        require('view/pages/login.php');
    }
}