<?php

namespace Blog\Manager;

use PDO;

class PostManager extends Manager
{
    public function getPosts(): array
    {
        $db = $this->dbConnect(PDO::FETCH_ASSOC);
        $stmt = $db->query(
            'SELECT posts.id, members.pseudo AS author, posts.title, posts.subtitle, posts.content, 
            DATE_FORMAT(posts.modified_at, \'%d/%m/%Y\') AS updatedDate,
            DATE_FORMAT(posts.modified_at, \'%Hh%m\') AS updatedTime
            FROM posts INNER JOIN members ON posts.author = members.id 
            ORDER BY posts.created_at DESC LIMIT 0, 10');
        $posts = $stmt->fetchAll();
        $stmt->closeCursor();

        return $posts;
    }

    function getOnePost($id)
    {
        $db = $this->dbConnect(PDO::FETCH_ASSOC);
        $stmt = $db->prepare(
            'SELECT posts.id,members.pseudo AS author, posts.title, posts.subtitle, posts.content, 
            DATE_FORMAT(posts.created_at, \'%d/%m/%Y\') AS updatedDate,
            DATE_FORMAT(posts.created_at, \'%Hh%m\') AS updatedTime 
            FROM posts INNER JOIN members ON posts.author = members.id
            WHERE posts.id = ?');
        $stmt->execute(array($id));
        $post = $stmt->fetch();
        $stmt->closeCursor();

        return $post;
    }
}