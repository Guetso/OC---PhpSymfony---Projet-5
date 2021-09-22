<?php

namespace Blog\Controller\App;

use Blog\Controller\ErrorController;
use Blog\Manager\PostManager;
use Blog\Manager\CommentManager;
use Exception;

class PostController extends AppController
{
    const COMMENTS_PER_PAGE = 5;

    private int $postId;

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function setPostId(int $postId): PostController
    {
        $this->postId = $postId;
        return $this;
    }

    public function setPageTitle($title): PostController
    {
        $this->pageTitle = parent::getPageTitle() . ' : ' . $title;
        return $this;
    }

    public function displayPosts(): string
    {
        $postManager = new PostManager();
        $posts       = $postManager->getPosts();
        $this->setPageTitle('Mes articles');
        return $this->render('pages/posts.html.twig', [
            'posts'     => $posts,
            'pageTitle' => $this->getPageTitle(),
            'errors'    => $this->getInfoMessages(),
        ]);
    }

    public function displayPost(): string
    {
        if (isset($_GET['post']) && $_GET['post'] > 0) {
            $_GET['post'] = (int)$_GET['post'];
            $this->setPostId($_GET['post']);
            $postId      = $this->getPostId();
            $postManager = new PostManager();
            try {
                $post = $postManager->getOnePost($postId);

                $this->setPageTitle($post->getTitle());
                $commentsDatas = $this->getPostComments($postId);
                $comments      = $commentsDatas['comments'];
                $commentNbPage = $commentsDatas['pageCommentNb'];
                $pageTitle     = $this->getPageTitle();
                $connected     = false;
                if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {
                    $connected = true;
                    if (isset($_POST['controlSubmit'])) {
                        $this->commentForm();
                    }
                }
                $errors = $this->getInfoMessages();
                return $this->render('pages/post.html.twig', [
                    'pageTitle'     => $pageTitle,
                    'post'          => $post,
                    'comments'      => $comments,
                    'commentNbPage' => $commentNbPage,
                    'connected'     => $connected,
                    'errors'        => $errors,
                ]);
            } catch (Exception $e) {
                $errorTitle      = 'Erreur ' . $e->getCode();
                $errorMessage    = 'La page demandée n\'existe pas.' . ' ' . $e->getMessage();
                $errorController = new ErrorController($errorTitle, $errorMessage);
                return $errorController->error();
            }
        } else {
            $errorTitle      = 'Erreur 400';
            $errorMessage    = 'La syntaxe de la requête est erronée.';
            $errorController = new ErrorController($errorTitle, $errorMessage);
            return $errorController->error();
        }
    }

    public function getPostComments($postId): array
    {
        if ((isset($_GET['page'])) && (!empty($_GET['page'])) && ($_GET['page'] > 0)) {
            $pageNbr = (int)($_GET['page']);
        } else {
            $pageNbr = 1;
        }
        $offset = ($pageNbr - 1) * self::COMMENTS_PER_PAGE;

        $commentManager = new CommentManager();
        $comments       = $commentManager->getPostComments($postId, self::COMMENTS_PER_PAGE, $offset, true);
        $comments_nb    = $commentManager->getCommentsNb($postId, true);

        $pageCommentNb = ceil($comments_nb / self::COMMENTS_PER_PAGE);
        if (isset($_GET['page']) && $_GET['page'] > $pageCommentNb) {
            $errorTitle      = 'Erreur 404';
            $errorMessage    = 'Cette page n\'existe pas !';
            $errorController = new ErrorController($errorTitle, $errorMessage);
            echo $errorController->error();
            die;
        }
        return compact('comments', 'pageCommentNb');
    }

    public function commentForm()
    {
        $validForm = true;
        if (empty($_POST['comment'])) {
            $validForm = false;
            $this->setInfoMessages('Votre commentaire est vide !');
        }
        if ($validForm === true) {
            $_POST['comment'] = htmlspecialchars($_POST['comment']);
            $commentManager   = new CommentManager();
            $postId           = $this->getPostId();
            try {
                $commentManager->createComment($postId, $_SESSION['id'], $_POST['comment']);
                header('Location: ?action=post&post=' . $postId);
            } catch (Exception $e) {
                $this->setInfoMessages($e->getMessage());
            }
        }
    }
}
