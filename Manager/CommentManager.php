<?php

namespace Blog\Manager;

use Blog\Model\Comment;
use PDO;

class CommentManager extends Manager
{
    public function getPostComments($postId, $commentsPerPage, $offset, $validatedOnly = false): array
    {
        $comments = [];
        $db       = $this->dbConnect(PDO::FETCH_ASSOC);
        if ($validatedOnly) {
            $stmt = $db->prepare(
                'SELECT comments.id,comments.postId, members.pseudo AS author , comments.content,
            comments.createdAt, comments.validated
            FROM comments INNER JOIN members ON comments.author = members.id
            WHERE postId = ?  AND validated = true
            ORDER BY comments.createdAt DESC
            LIMIT ? OFFSET ?'
            );
        } else {
            $stmt = $db->prepare(
                'SELECT comments.id,comments.postId, members.pseudo AS author , comments.content,
            comments.createdAt, comments.validated
            FROM comments INNER JOIN members ON comments.author = members.id
            WHERE postId = ?
            ORDER BY comments.createdAt DESC
            LIMIT ? OFFSET ?'
            );
        }
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

    public function getCommentsNb($postId, $validatedOnly = false)
    {
        $db = $this->dbConnect(PDO::FETCH_ASSOC);
        if ($validatedOnly) {
            $stmt = $db->prepare('SELECT COUNT(*) AS nb_comments FROM comments WHERE postId = ? AND validated = true');
        } else {
            $stmt = $db->prepare('SELECT COUNT(*) AS nb_comments FROM comments WHERE postId = ?');
        }
        $stmt->execute(array($postId));
        $number = $stmt->fetch()['nb_comments'];
        $stmt->closeCursor();
        return $number;
    }

    public function createComment($postId, $author, $comment)
    {
        $db   = $this->dbConnect(PDO::FETCH_ASSOC);
        $stmt = $db->prepare('INSERT INTO comments (postId, author, content) VALUES(:postId, :author, :content)');
        try {
            $stmt->execute(
                array(
                    'postId'  => $postId,
                    'author'  => $author,
                    'content' => $comment
                )
            );
        } finally {
            $stmt->closeCursor();
        }
    }

    public function deleteComment($commentId)
    {
        $db   = $this->dbConnect(PDO::FETCH_ASSOC);
        $stmt = $db->prepare(
            'DELETE FROM comments WHERE id = ?'
        );
        $stmt->execute(array($commentId));
        $stmt->closeCursor();
    }

    public function toggleValidated($validState, $commentId)
    {
        $db   = $this->dbConnect(PDO::FETCH_ASSOC);
        $stmt = $db->prepare('UPDATE comments SET validated = :validState WHERE comments.id = :commentId');
        try {
            $stmt->execute(
                array(
                    'validState' => $validState,
                    'commentId'  => $commentId,
                )
            );
        } finally {
            $stmt->closeCursor();
        }
    }
}
