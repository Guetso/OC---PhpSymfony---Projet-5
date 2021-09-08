<?php


namespace Blog\Controller;

use Blog\Manager\AuthManager;
use Exception;

class SignupController extends Controller
{
    public function __construct()
    {
        $this->setTitle('Inscription');
    }

    public function signup()
    {
        if (isset($_POST['controlSubmit'])) {
            $validForm = true;
            if (empty($_POST['pseudo'])
                || empty($_POST['email'])
                || empty($_POST['password'])
                || empty($_POST['passwordConfirm'])) {
                $validForm = false;
                $this->setInfoMessages('Il faut renseigner tous les champs !');
            }
            if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
                $validForm = false;
                $this->setInfoMessages('L\'adresse email n\'est pas valide !');
            }
            if (!preg_match(
                "#^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$#",
                $_POST['password'])) {
                $validForm = false;
                $this->setInfoMessages('Le mot de passe n\'est pas valide !');
            }
            if ($_POST['password'] !== $_POST['passwordConfirm']) {
                $validForm = false;
                $this->setInfoMessages('La confirmation du mot de passe a échouée !');
            }
            if ($validForm === true) {
                $_POST['pseudo']          = htmlspecialchars($_POST['pseudo']);
                $_POST['email']           = htmlspecialchars($_POST['email']);
                $_POST['password']        = htmlspecialchars($_POST['password']);
                $_POST['passwordConfirm'] = htmlspecialchars($_POST['passwordConfirm']);

                $pass_hache  = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $authManager = new AuthManager();
                try {
                    $authManager->signup($_POST['pseudo'], $pass_hache, $_POST['email']);
                    try {
                        $login = $authManager->login($_POST['pseudo'], $_POST['password']);
                        setSession($login['id'], $login['pseudo']);
                        header('Location: ?action=welcome');
                    } catch (Exception $e) {
                        $this->setInfoMessages($e->getMessage());
                    }
                } catch (Exception $e) {
                    $sqlErrorMessages = $e->getMessage();
                    if (str_contains($e->getMessage(), 'pseudo')) {
                        $this->setInfoMessages('Ce pseudo est déjà utilisé');
                    } elseif (str_contains($sqlErrorMessages, 'email')) {
                        $this->setInfoMessages('Cet email est déjà utilisé');
                    } else {
                        $this->setInfoMessages($e->getMessage());
                    }
                }
            }
        }
        $pageTitle = $this->getTitle();
        $errors    = $this->getInfoMessages();
        $this->render('pages.signup', compact('pageTitle', 'errors'));
    }
}