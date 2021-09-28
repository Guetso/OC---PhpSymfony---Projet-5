<?php

namespace Blog\Controller\Admin;

use Blog\Controller\ErrorController;
use Blog\Manager\PostManager;
use Blog\Manager\CommentManager;
use Blog\services\CommentServices;
use Exception;

class PostController extends AdminController
{
    const COMMENTS_PER_PAGE = 5;

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
        if (!isset($_GET['post'])) {
            throw new Exception('La syntaxe de la requête est erronée.');
        }
        $_GET['post'] = (int)$_GET['post'];
        $postId       = $_GET['post'];
        $postManager  = new PostManager();
        try {
            $post = $postManager->getOnePost($postId);
            $this->setPageTitle('modifier un article');
            $commentsDatas = (new CommentController())->getPostComments($postId);
            $comments      = $commentsDatas['comments'];
            $commentNbPage = $commentsDatas['pageCommentNb'];
            $pageTitle     = $this->getPageTitle();
            if (isset($_POST['commentControlSubmit']) && isset($_POST['valid']) && isset($_POST['id'])) {
                if ($_POST['id'] > 0) {
                    $_POST['id'] = (int)$_POST['id'];
                    $this->toggleCommentState(1, $_POST['id']);
                } else {
                    throw new Exception();
                }
            }
            if (isset($_POST['commentControlSubmit']) && isset($_POST['invalid']) && isset($_POST['id'])) {
                if ($_POST['id'] > 0) {
                    $_POST['id'] = (int)$_POST['id'];
                    $this->toggleCommentState(0, $_POST['id']);
                } else {
                    throw new Exception();
                }
            }
            if (isset($_POST['commentControlSubmit']) && isset($_POST['delete']) && isset($_POST['id'])) {
                if ($_POST['id'] > 0) {
                    $_POST['id'] = (int)$_POST['id'];
                    $this->deleteComment($_POST['id']);
                } else {
                    throw new Exception();
                }
            }
            $errors = $this->getInfoMessages();
            return $this->render('pages/admin/post.html.twig', [
                'pageTitle'     => $pageTitle,
                'post'          => $post,
                'comments'      => $comments,
                'commentNbPage' => $commentNbPage,
                'errors'        => $errors,
            ]);
        } catch (Exception $e) {
            throw new Exception('La page demandée n\'existe pas.' . ' ' . $e->getMessage());
        }
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

/*    public function toggleCommentState($validState, $commentId)
    {
        $commentsManager = new CommentManager();
        $commentsManager->toggleValidated($validState, $commentId);
        header('Refresh:0');
    }

    public function deleteComment($commentId)
    {
        $commentsManager = new CommentManager();
        $commentsManager->deleteComment($commentId);
        header('Refresh:0');
    }*/
}
