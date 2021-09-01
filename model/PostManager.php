<?php

namespace Hugo\Blog\Model;
require_once('model/Manager.php');

class PostManager extends Manager
{
    public function getPosts()
    {
        $db    = $this->dbConnect();
        $stmt  = $db->query(
            'SELECT id, author, title, subtitle, content, DATE_FORMAT(modified_at, \'%d/%m/%Y\') AS date,
            DATE_FORMAT(modified_at, \'%Hh%imin%ss\') AS time
            FROM posts ORDER BY created_at DESC LIMIT 0, 10');
        $posts = $stmt->fetchAll();
        $stmt->closeCursor();

        return $posts;
    }

    function getOnePost($id)
    {
        $db   = $this->dbConnect();
        $stmt = $db->prepare(
            'SELECT id,author, title, subtitle, content, 
            DATE_FORMAT(created_at, \'%d/%m/%Y\') AS date,
            DATE_FORMAT(created_at, \'%Hh%imin%ss\') AS time 
            FROM posts 
            WHERE id = ?');
        $stmt->execute(array($id));
        $post = $stmt->fetch();
        $stmt->closeCursor();

        return $post;
    }
}