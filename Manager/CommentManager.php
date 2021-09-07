<?php
namespace Blog\Manager;
use PDO;
use PDOException;

require_once('Manager/Manager.php');

class CommentManager extends Manager
{
    public function getPostComments($id_post, $commentsPerPage, $offset) : array
    {
        $db = $this->dbConnect();
        $stmt = $db->prepare(
            'SELECT comments.post_id, members.pseudo AS author , comments.content,
            DATE_FORMAT(comments.created_at, \'%d/%m/%Y\') AS date,
            DATE_FORMAT(comments.created_at, \'%Hh%imin%ss\') AS time
            FROM comments INNER JOIN members ON comments.author = members.id
            WHERE post_id = ? ORDER BY comments.created_at DESC
            LIMIT ? OFFSET ?');
        $stmt->bindParam(1, $id_post, PDO::PARAM_INT);
        $stmt->bindParam(2, $commentsPerPage, PDO::PARAM_INT);
        $stmt->bindParam(3, $offset, PDO::PARAM_INT);
        $stmt->execute();
        $comments = $stmt->fetchAll();
        $stmt->closeCursor();

        return $comments;
    }

    public function getCommentsNb($id_post)
    {
        $db = $this->dbConnect();
        $stmt = $db->prepare('SELECT COUNT(*) AS nb_comments FROM comments WHERE post_id = ?');
        $stmt->execute(array($id_post));
        $nber = $stmt->fetch()['nb_comments'];
        $stmt->closeCursor();
        return $nber;
    }

    public function createPostComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $stmt = $db->prepare('INSERT INTO comments (post_id, author, content) VALUES(:post_id, :author, :content)');
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
}