<?php

namespace Blog\Controller\Admin;

use Blog\Controller\ErrorController;
use Blog\Manager\PostManager;
use Blog\Manager\CommentManager;
use Exception;

class PostController extends AdminController
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

    public function setPageTitle(string $title): PostController
    {
        $this->pageTitle = parent::getPageTitle() . ' : ' . $title;
        return $this;
    }

    public function displayPosts(): string
    {
        $postManager = new PostManager();
        $posts       = $postManager->getPosts();
        $this->setPageTitle('Mes articles');
        return $this->render('pages/admin/posts.html.twig', [
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

                $this->setPageTitle('modifier un article');
                $commentsDatas = $this->getPostComments($postId);
                $comments      = $commentsDatas['comments'];
                $commentNbPage = $commentsDatas['pageCommentNb'];
                $pageTitle     = $this->getPageTitle();
                $connected     = false;
                if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {
                    $connected = true;
                    if (isset($_POST['controlSubmit'])) {
                        $this->postForm();
                    }
                }
                $errors = $this->getInfoMessages();
                return $this->render('pages/admin/post.html.twig', [
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
        $comments       = $commentManager->getPostComments($postId, self::COMMENTS_PER_PAGE, $offset);
        $comments_nb    = $commentManager->getCommentsNb($postId);

        $pageCommentNb = ceil($comments_nb / self::COMMENTS_PER_PAGE);
        if (isset($_GET['page']) && $_GET['page'] > $pageCommentNb) {
            $errorTitle      = 'Erreur 404';
            $errorMessage    = 'Cette page n\'existe pas !';
            $errorController = new ErrorController($errorTitle, $errorMessage);
            $errorController->error();
            die;
        }
        return compact('comments', 'pageCommentNb');
    }

    public function addPost(): string
    {
        if (isset($_POST['controlSubmit'])) {
            $this->postForm();
        }
        $errors = $this->getInfoMessages();
        return $this->render('pages/admin/newPost.html.twig', ['errors' => $errors,]);
    }

    public function deletePost()
    {
        if (isset($_GET['post']) && $_GET['post'] > 0) {
            $_GET['post'] = (int)$_GET['post'];
            $postManager  = new PostManager();
            try {
                $postManager->deletePost($_GET['post']);
                header('Location: ?action=posts');
            } catch (Exception $e) {
                $errorTitle      = 'Erreur ' . $e->getCode();
                $errorMessage    = 'La page demandée n\'existe pas.' . ' ' . $e->getMessage();
                $errorController = new ErrorController($errorTitle, $errorMessage);
                echo $errorController->error();
            }
        } else {
            $errorTitle      = 'Erreur 400';
            $errorMessage    = 'La syntaxe de la requête est erronée.';
            $errorController = new ErrorController($errorTitle, $errorMessage);
            echo $errorController->error();
        }
    }

    public function postForm()
    {
        $validForm = true;
        if (empty($_POST['title']) || empty($_POST['subtitle']) || empty($_POST['content'])) {
            $validForm = false;
            $this->setInfoMessages('Un champ est vide !');
        }
        if (strlen($_POST['title']) > 255) {
            $validForm = false;
            $this->setInfoMessages('Le titre est trop long');
        }
        if (strlen($_POST['subtitle']) > 255) {
            $validForm = false;
            $this->setInfoMessages('Le chapo est trop long');
        }
        if (strlen($_POST['content']) > 10000) {
            $validForm = false;
            $this->setInfoMessages('L\'article est trop long');
        }
        if ($validForm === true) {
            $postTitle    = htmlspecialchars($_POST['title']);
            $postSubtitle = htmlspecialchars($_POST['subtitle']);
            $postContent  = htmlspecialchars($_POST['content']);
            $postId       = htmlspecialchars($_POST['id']);
            $postAuthor   = $_SESSION['id'];
            $postManager  = new PostManager();
            try {
                if ($_GET['action'] === 'post.add') {
                    $postDatas = compact('postTitle', 'postSubtitle', 'postContent', 'postAuthor');
                    $postManager->addPost($postDatas);
                } elseif ($_GET['action'] === 'post') {
                    $postDatas = compact('postId', 'postTitle', 'postSubtitle', 'postContent');
                    $postManager->modifyPost($postDatas);
                }
                header('Location: ?action=posts');
            } catch (Exception $e) {
                $this->setInfoMessages($e->getMessage());
            }
        }
    }
}
