<?php

namespace Blog\Manager;

use Blog\Model\Post;
use Exception;
use PDO;

class PostManager extends Manager
{
    public function getPosts(): array
    {
        $posts      = [];
        $db         = $this->dbConnect(PDO::FETCH_ASSOC);
        $stmt       = $db->query(
            'SELECT 
       posts.id, 
       members.pseudo AS author, 
       posts.title, 
       posts.subtitle, 
       posts.content, 
       posts.createdAt,
       posts.modifiedAt
            FROM posts INNER JOIN members ON posts.author = members.id 
            ORDER BY posts.createdAt DESC LIMIT 0, 10'
        );
        $postsDatas = $stmt->fetchAll();
        $stmt->closeCursor();

        foreach ($postsDatas as $postDatas) {
            $posts[] = new Post($postDatas);
        }
        return $posts;
    }

    public function getOnePost($id): Post
    {
        $db   = $this->dbConnect(PDO::FETCH_ASSOC);
        $stmt = $db->prepare(
            'SELECT 
       posts.id,
       members.pseudo AS author, 
       posts.title, 
       posts.subtitle, 
       posts.content, 
       posts.createdAt,
       posts.modifiedAt
        FROM posts INNER JOIN members ON posts.author = members.id
        WHERE posts.id = ?'
        );
        $stmt->execute(array($id));
        $postData = $stmt->fetch();
        $stmt->closeCursor();
        if ($postData) {
            return new Post($postData);
        } else {
            throw new Exception(code: 404);
        }
    }

    public function addPost($postDatas)
    {
        $db   = $this->dbConnect(PDO::FETCH_ASSOC);
        $stmt = $db->prepare(
            'INSERT INTO posts (title, subtitle, content, author) 
        VALUES(:postTitle, :postSubtitle, :postContent, :postAuthor)'
        );
        try {
            $stmt->execute($postDatas);
        } finally {
            $stmt->closeCursor();
        }
    }

    public function modifyPost($postDatas)
    {
        $db   = $this->dbConnect(PDO::FETCH_ASSOC);
        $stmt = $db->prepare(
            "UPDATE posts SET title = :postTitle, subtitle = :postSubtitle,content = :postContent 
            WHERE posts.id = :postId"
        );
        try {
            $stmt->execute($postDatas);
        } finally {
            $stmt->closeCursor();
        }
    }

    public function deletePost($id)
    {
        $db   = $this->dbConnect(PDO::FETCH_ASSOC);
        $stmt = $db->prepare(
            'DELETE FROM posts WHERE id = ?'
        );
        $stmt->execute(array($id));
        $stmt->closeCursor();
    }
}
