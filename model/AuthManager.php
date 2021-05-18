<?php
namespace Hugo\Blog\Model;
use Exception;
use PDOException;

require_once('model/Manager.php');

class AuthManager extends Manager
{
    public function signup($pseudo, $pass_hache, $email)
    {
        $bd = $this->dbConnect();
        $stmt = $bd->prepare('INSERT INTO members (pseudo, pass, email) VALUES(:pseudo, :pass, :email)');
        try {
            $stmt->execute(array(
                    'pseudo' => $pseudo,
                    'pass' => $pass_hache,
                    'email' => $email)
            );
        } catch (PDOException  $sqlError) {
            throw $sqlError;
        } finally {
            $stmt->closeCursor();
        }
    }

    public function getLogin($pseudo, $pass)
    {
        $bd = $this->dbConnect();
        $stmt = $bd->prepare('SELECT id, pseudo, pass FROM members WHERE pseudo = :pseudo');
        try {
            $stmt->execute(array(
                    'pseudo' => $pseudo
                )
            );
            $response = $stmt->fetch();
            $isPassCorrect = password_verify($pass, $response['pass'] ?? '');
            $messageError = 'Mauvais identifiant ou mot de passe !';
            if (!$response) {
                throw new Exception($messageError);
            } else {
                if ($isPassCorrect) {
                    return $response;
                } else {
                    throw new Exception($messageError);
                }
            }
        } catch (Exception $e) {
            throw $e;
        } finally {
            $stmt->closeCursor();
        }
    }
}