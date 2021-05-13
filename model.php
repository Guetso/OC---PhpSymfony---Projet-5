<?php
require('./utils/pdo.php');

/**
 * @return array
 */
function getPosts()
{
    $bdd = dbConnect();
    $stmt = $bdd->query(
        'SELECT id, title, content, DATE_FORMAT(created_at, \'%d/%m/%Y\') AS date,
      DATE_FORMAT(created_at, \'%Hh%imin%ss\') AS time
      FROM posts ORDER BY created_at DESC LIMIT 0, 10');
    $req = $stmt->fetchAll();
    $stmt->closeCursor();

    return $req;
}

/**
 * @param $id
 * @return mixed
 */
function getOnePost($id)
{
    $bdd = dbConnect();
    $stmt = $bdd->prepare(
        'SELECT id, title, content, 
        DATE_FORMAT(created_at, \'%d/%m/%Y\') AS date,
        DATE_FORMAT(created_at, \'%Hh%imin%ss\') AS time 
    FROM posts 
    WHERE id = ?'
    );
    $stmt->execute(array($id));
    $req = $stmt->fetch();
    $stmt->closeCursor();

    return $req;
}

/**
 * @param $id_post
 * @param $commentsPerPage
 * @param $offset
 * @return array
 */
function getPostComments($id_post, $commentsPerPage, $offset)
{
    $bdd = dbConnect();
    $stmt = $bdd->prepare(
        'SELECT comments.post_id, members.pseudo AS author , comments.content,
   DATE_FORMAT(comments.created_at, \'%d/%m/%Y\') AS date,
   DATE_FORMAT(comments.created_at, \'%Hh%imin%ss\') AS time
   FROM comments INNER JOIN members ON comments.author = members.id
   WHERE post_id = ? ORDER BY comments.created_at DESC
   LIMIT ? OFFSET ?'
    );
    $stmt->bindParam(1, $id_post, PDO::PARAM_INT);
    $stmt->bindParam(2, $commentsPerPage, PDO::PARAM_INT);
    $stmt->bindParam(3, $offset, PDO::PARAM_INT);
    $stmt->execute();
    $req = $stmt->fetchAll();
    $stmt->closeCursor();
    return $req;
}

/**
 * @param $id_post
 * @return mixed
 */
function getCommentsNb($id_post)
{
    $bdd = dbConnect();
    $stmt = $bdd->prepare('SELECT COUNT(*) AS nb_comments FROM comments WHERE post_id = ?');
    $stmt->execute(array($id_post));
    $req = $stmt->fetch()['nb_comments'];
    $stmt->closeCursor();
    return $req;
}

/**
 * @param $pseudo
 * @param $pass_hache
 * @param $email
 */
function signup($pseudo, $pass_hache, $email)
{
    $bdd = dbConnect();
    $stmt = $bdd->prepare('INSERT INTO members (pseudo, pass, email) VALUES(:pseudo, :pass, :email)');
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

/**
 * @param $pseudo
 * @param $pass
 * @return mixed
 * @throws Exception
 */
function getLogin($pseudo, $pass)
{
    $bdd = dbConnect();
    $stmt = $bdd->prepare('SELECT id, pseudo, pass FROM members WHERE pseudo = :pseudo');
    try {
        $stmt->execute(array(
                'pseudo' => $pseudo
            )
        );
        $response = $stmt->fetch();
        $isPassCorrect = password_verify($pass, $response['pass'] ?? '');
        $passError = 'Mauvais identifiant ou mot de passe !';
        if (!$response) {
            throw new Exception($passError);
        } else {
            if ($isPassCorrect) {
                return $response;
            } else {
                throw new Exception($passError);
            }
        }
    } catch (Exception $e) {
        throw $e;
    } finally {
        $stmt->closeCursor();
    }
}

/**
 * @param $postId
 * @param $author
 * @param $comment
 */
function createPostComment($postId, $author, $comment)
{
    $bdd = dbConnect();
    $stmt = $bdd->prepare('INSERT INTO comments (post_id, author, content) VALUES(:post_id, :author, :content)');
    try {
        $stmt->execute(array(
                'post_id' => $postId,
                'author' => $author,
                'content' => $comment)
        );
    } catch (PDOException  $sqlError) {
        throw $sqlError;
    } finally {
        $stmt->closeCursor();
    }
}