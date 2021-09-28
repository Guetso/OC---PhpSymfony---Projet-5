<?php

namespace Blog\Controller\App;

use Blog\Manager\CommentManager;
use Blog\services\CommentServices;
use Exception;

class CommentController extends AppController
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
        $comments        = $commentServices->getPostComments($postId, self::COMMENTS_PER_PAGE, $offset, true);
        $comments_nb     = $commentServices->getCommentsNb($postId, true);
        $pageCommentNb   = ceil($comments_nb / self::COMMENTS_PER_PAGE);

        if (isset($_GET['page']) && $_GET['page'] > $pageCommentNb) {
            throw new Exception();
        }
        return compact('comments', 'pageCommentNb');
    }

    public function commentForm()
    {
        if (empty($_POST['comment'])) {
            throw new Exception('Votre commentaire est vide !');
        }
        $_POST['comment'] = htmlspecialchars($_POST['comment']);
        $postId           = $_GET['post'];
        $commentManager   = new CommentManager();
        try {
            $commentManager->createComment($postId, $_SESSION['id'], $_POST['comment']);
            header('Location: ?action=post&post=' . $postId);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
