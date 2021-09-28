<?php

namespace Blog\Controller\App;

use Blog\Controller\ErrorController;
use Blog\Manager\PostManager;
use Blog\services\CommentServices;
use Exception;

class PostController extends AppController
{
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
        if (!isset($_GET['post'])) {
            throw new Exception('La syntaxe de la requête est erronée.');
        }
        $_GET['post'] = (int)$_GET['post'];
        $postId       = $_GET['post'];
        $postManager  = new PostManager();
        try {
            $post          = $postManager->getOnePost($postId);
            $commentsDatas = (new CommentController())->getPostComments($postId);
            $comments      = $commentsDatas['comments'];
            $commentNbPage = $commentsDatas['pageCommentNb'];
            $this->setPageTitle($post->getTitle());
            $pageTitle = $this->getPageTitle();
            $connected = false;
            if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {
                $connected = true;
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
            throw new Exception('La page demandée n\'existe pas.' . ' ' . $e->getMessage());
        }
    }
}
