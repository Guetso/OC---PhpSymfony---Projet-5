<?php

namespace Blog\Controller;

use Blog\Manager\PostManager;
use Exception;

class PostController extends Controller
{
    public function setTitle($title): Controller
    {
        $this->title = parent::getTitle() . ' : ' . $title;
        return $this;
    }

    public function post()
    {
        if (isset($_GET['post']) && $_GET['post'] > 0) {
            $_GET['post'] = (int)$_GET['post'];
            $postManager  = new PostManager();
            try {
                $post     = $postManager->getOnePost($_GET['post']);
                $postData = [
                    'id_post'         => $post['id'],
                    'updatedDateTime' => 'le ' . htmlspecialchars($post['updatedDate']) . 'à ' . $post['updatedTime'],
                    'postAuthor'      => htmlspecialchars($post['author']),
                    'postTitle'       => htmlspecialchars($post['title']),
                    'postChapo'       => htmlspecialchars($post['subtitle']),
                    'postContent'     => htmlspecialchars($post['content'])
                ];

                $commentsController = new CommentsController($postData['id_post']);
                $commentsComponent  = $commentsController->commentsComponents();

                $this->setTitle($postData['postTitle']);
                $pageTitle = $this->getTitle();
                $errors    = $this->getErrorMessages();

                if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {
                    $commentFormController = new CommentFormController($postData['id_post']);
                    $commentFormComponent  = $commentFormController->commentFormComponent();
                    $this->render(
                        'pages.post', compact('postData', 'pageTitle', 'errors'),
                        [$commentsComponent, $commentFormComponent]);
                } else {
                    $this->render(
                        'pages.post', compact('postData', 'pageTitle', 'errors'),
                        [$commentsComponent]);
                }
            } catch (Exception $e) {
                $this->setErrorMessages($e->getMessage());
            }
        } else {
            $errorTitle      = 'Erreur 400';
            $errorMessage    = 'La syntaxe de la requête est erronée.';
            $errorController = new ErrorController($errorTitle, $errorMessage);
            $errorController->error();
        }
    }
}