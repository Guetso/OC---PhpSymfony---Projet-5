<?php

namespace Blog\Controller;

use Blog\Manager\CommentManager;

class CommentsController extends Controller
{
    const COMMENTS_PER_PAGE = 5;

    private int $postId;

    public function __construct($postId)
    {
        $this->setPostId($postId);
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function setPostId(int $postId): CommentsController
    {
        $this->postId = $postId;
        return $this;
    }

    public function commentsComponents(): array
    {
        if ((isset($_GET['page'])) && (!empty($_GET['page'])) && ($_GET['page'] > 0)) {
            $pageNbr = (int)($_GET['page']);
        } else {
            $pageNbr = 1;
        }
        $offset = ($pageNbr - 1) * self::COMMENTS_PER_PAGE;
        $postId = $this->getPostId();

        $commentManager = new CommentManager();
        $comments       = $commentManager->getPostComments($postId, self::COMMENTS_PER_PAGE, $offset);
        $comments_nb    = $commentManager->getCommentsNb($postId);
        $pageCommentNb  = ceil($comments_nb / self::COMMENTS_PER_PAGE);

        if (isset($_GET['page']) && $_GET['page'] > $pageCommentNb) {
            $errorTitle      = 'Erreur 404';
            $errorMessage    = 'Cette page n\'existe pas !';
            $errorController = new ErrorController($errorTitle, $errorMessage);
            $errorController->error();
        }

        $view      = 'components.comments';
        $variables = compact('postId', 'comments', 'pageCommentNb',);
        return compact('view', 'variables');
    }
}