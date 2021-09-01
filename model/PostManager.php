<?php

namespace Hugo\Blog\Model;
require_once('model/Manager.php');

class PostManager extends Manager
{
    public function getPosts()
    {
        $db    = $this->dbConnect();
        $stmt  = $db->query(
            'SELECT posts.id, members.pseudo AS author, posts.title, posts.subtitle, posts.content, 
            DATE_FORMAT(posts.modified_at, \'%d/%m/%Y\') AS date,
            DATE_FORMAT(posts.modified_at, \'%Hh%imin%ss\') AS time
            FROM posts INNER JOIN members ON posts.author = members.id 
            ORDER BY posts.created_at DESC LIMIT 0, 10');
        $posts = $stmt->fetchAll();
        $stmt->closeCursor();

        return $posts;
    }

    function getOnePost($id)
    {
        $db   = $this->dbConnect();
        $stmt = $db->prepare(
            'SELECT posts.id,members.pseudo AS author, posts.title, posts.subtitle, posts.content, 
            DATE_FORMAT(posts.created_at, \'%d/%m/%Y\') AS date,
            DATE_FORMAT(posts.created_at, \'%Hh%imin%ss\') AS time 
            FROM posts INNER JOIN members ON posts.author = members.id
            WHERE posts.id = ?');
        $stmt->execute(array($id));
        $post = $stmt->fetch();
        $stmt->closeCursor();

        return $post;
    }
}