<?php


namespace Blog\Controller;

use Blog\Manager\CommentManager;
use Exception;

class CommentFormController extends Controller
{

    private int $postId;

    public function __construct($postId)
    {
        $this->setPostId($postId);
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function setPostId(int $postId): CommentFormController
    {
        $this->postId = $postId;
        return $this;
    }

    public function commentFormComponent(): array
    {
        if (isset($_POST['controlSubmit'])) {
            $validForm = true;
            if (empty($_POST['comment'])) {
                $validForm = false;
                $this->setErrorMessages('Votre commentaire est vide !');
            }
            if ($validForm === true) {
                $_POST['comment'] = htmlspecialchars($_POST['comment']);
                $commentManager = new CommentManager();
                $postId = $this->getPostId();
                try {
                    $commentManager->createPostComment($postId, $_SESSION['id'], $_POST['comment']);
                    header('Location: ?action=post&post='. $postId);
                } catch
                (Exception $e) {
                    $this->setErrorMessages($e->getMessage());
                }
            }
        }
        $view = 'components.commentsForm';
        $errors = $this->getErrorMessages();
        $variables = compact('errors');
        return compact('view', 'variables');
    }

}