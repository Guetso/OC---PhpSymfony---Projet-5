<?php

namespace Blog\services;

use Blog\Manager\CommentManager;

class CommentServices
{
    public function getPostComments($postId, $commentsPerPage, $offset, $validatedOnly = false): array
    {
        $commentManager = new CommentManager();
        return $commentManager->getPostComments($postId, $commentsPerPage, $offset, $validatedOnly);
    }

    public function getCommentsNb($postId, $validatedOnly = false)
    {
        $commentManager = new CommentManager();
        return $commentManager->getCommentsNb($postId, $validatedOnly);
    }
}