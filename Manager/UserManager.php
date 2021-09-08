<?php

namespace Blog\Manager;

use PDO;
use Exception;

class UserManager extends Manager
{
    private const ERROR_LOGIN = 'Mauvais identifiant ou mot de passe !';

    public function signup($pseudo, $pass_hache, $email)
    {
        $bd   = $this->dbConnect(PDO::FETCH_ASSOC);
        $stmt = $bd->prepare('INSERT INTO members (pseudo, pass, email) VALUES(:pseudo, :pass, :email)');
        try {
            $stmt->execute(
                array(
                    'pseudo' => $pseudo,
                    'pass'   => $pass_hache,
                    'email'  => $email
                )
            );
        } catch (Exception $e) {
            throw $e;
        } finally {
            $stmt->closeCursor();
        }
    }

    public function login($pseudo, $pass)
    {
        $bd   = $this->dbConnect(PDO::FETCH_ASSOC);
        $stmt = $bd->prepare('SELECT id, pseudo, pass FROM members WHERE pseudo = :pseudo');
        try {
            $stmt->execute(
                array(
                    'pseudo' => $pseudo
                )
            );
            $response      = $stmt->fetch();
            $isPassCorrect = password_verify($pass, $response['pass'] ?? '');
            if (!$response) {
                throw new Exception(self::ERROR_LOGIN);
            } else {
                if ($isPassCorrect) {
                    return $response;
                } else {
                    throw new Exception(self::ERROR_LOGIN);
                }
            }
        } catch (Exception $e) {
            throw $e;
        } finally {
            $stmt->closeCursor();
        }
    }
}