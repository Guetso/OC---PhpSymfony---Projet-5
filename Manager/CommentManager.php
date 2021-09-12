<?php

namespace Blog\Manager;

use Blog\Model\Comment;
use PDO;

require_once('Manager/Manager.php');

class CommentManager extends Manager
{
    public function getPostComments($postId, $commentsPerPage, $offset): array
    {
        $comments      = [];
        $db   = $this->dbConnect(PDO::FETCH_ASSOC);
        $stmt = $db->prepare(
            'SELECT comments.id,comments.postId, members.pseudo AS author , comments.content,
            comments.createdAt
            FROM comments INNER JOIN members ON comments.author = members.id
            WHERE postId = ? ORDER BY comments.createdAt DESC
            LIMIT ? OFFSET ?');
        $stmt->bindParam(1, $postId, PDO::PARAM_INT);
        $stmt->bindParam(2, $commentsPerPage, PDO::PARAM_INT);
        $stmt->bindParam(3, $offset, PDO::PARAM_INT);
        $stmt->execute();
        $commentsDatas = $stmt->fetchAll();
        $stmt->closeCursor();

        foreach ($commentsDatas as $commentDatas) {
            $comments[] = new Comment($commentDatas);
        }
        return $comments;
    }

    public function getCommentsNb($postId)
    {
        $db   = $this->dbConnect(PDO::FETCH_ASSOC);
        $stmt = $db->prepare('SELECT COUNT(*) AS nb_comments FROM comments WHERE postId = ?');
        $stmt->execute(array($postId));
        $number = $stmt->fetch()['nb_comments'];
        $stmt->closeCursor();
        return $number;
    }

    public function createPostComment($postId, $author, $comment)
    {
        $db   = $this->dbConnect(PDO::FETCH_ASSOC);
        $stmt = $db->prepare('INSERT INTO comments (postId, author, content) VALUES(:postId, :author, :content)');
        try {
            $stmt->execute(
                array(
                    'postId' => $postId,
                    'author'  => $author,
                    'content' => $comment
                )
            );
        } finally {
            $stmt->closeCursor();
        }
    }
}