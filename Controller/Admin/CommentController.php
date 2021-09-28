<?php

namespace Blog\Controller\Admin;

use Blog\Manager\CommentManager;
use Blog\services\CommentServices;
use Exception;

class CommentController extends AdminController
{
    const COMMENTS_PER_PAGE = 5;

    public function getPostComments($postId): array
    {
        if ((isset($_GET['page'])) && (!empty($_GET['page']))) {
            $_GET['page'] = (int)($_GET['page']);
            if ($_GET['page'] <= 0) {
                throw new Exception();
            }
            $pageNbr = $_GET['page'];
        } else {
            $pageNbr = 1;
        }
        $offset          = ($pageNbr - 1) * self::COMMENTS_PER_PAGE;
        $commentServices = new CommentServices();
        $comments        = $commentServices->getPostComments($postId, self::COMMENTS_PER_PAGE, $offset);
        $comments_nb     = $commentServices->getCommentsNb($postId);
        $pageCommentNb   = ceil($comments_nb / self::COMMENTS_PER_PAGE);

        if (isset($_GET['page']) && $_GET['page'] > $pageCommentNb) {
            throw new Exception();
        }
        return compact('comments', 'pageCommentNb');
    }

    public function toggleCommentState($validState, $commentId)
    {
        if (!isset($_POST['id']) || (!isset($_POST['valid']))) { // TODO J'en suis là, ajouter la condition 'Si valid ou invalid n'est pas set
            throw new Exception();
        }
        $commentsManager = new CommentManager();
        $commentsManager->toggleValidated($validState, $commentId);
        header('Refresh:0');
    }

    public function deleteComment($commentId)
    {
        $commentsManager = new CommentManager();
        $commentsManager->deleteComment($commentId);
        header('Refresh:0');
    }
}
