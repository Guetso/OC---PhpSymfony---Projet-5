<?php

namespace Blog\Controller;

use Blog\Manager\PostManager;
use Blog\Manager\CommentManager;
use Exception;

class PostController extends Controller
{

    const COMMENTS_PER_PAGE = 5;

    private int $postId;

    public function posts()
    {
        $postManager = new PostManager();
        $posts       = $postManager->getPosts();
        $postsData   = [];
        foreach ($posts as $post) {
            $postsData[] = [
                'postDetails' => htmlspecialchars($post['title']) .
                    ' le ' . htmlspecialchars($post['updatedDate']) .
                    ' à ' . htmlspecialchars($post['updatedTime']),
                'postChapo'   => htmlspecialchars($post['subtitle']),
                'postAuthor'  => $post['author'] ? htmlspecialchars($post['author']) : 'utilisateur inconnu',
                'postLink'    => '?action=post&post=' . htmlspecialchars($post['id'])
            ];
        }
        $pageTitle = 'Mes articles';
        $errors    = $this->getInfoMessages();
        $this->render('pages.posts', compact('postsData', 'pageTitle', 'errors'));
    }

    public function post()
    {
        if (isset($_GET['post']) && $_GET['post'] > 0) {
            $_GET['post'] = (int)$_GET['post'];
            $this->setPostId($_GET['post']);
            $postId      = $this->getPostId();
            $postManager = new PostManager();

            try {
                $postDatas = $postManager->getOnePost($postId);
                $post      = [
                    'id'              => $postDatas['id'],
                    'updatedDateTime' => 'le ' . htmlspecialchars(
                            $postDatas['updatedDate']) . ' à ' . $postDatas['updatedTime'],
                    'author'          => htmlspecialchars($postDatas['author']),
                    'title'           => htmlspecialchars($postDatas['title']),
                    'chapo'           => htmlspecialchars($postDatas['subtitle']),
                    'content'         => htmlspecialchars($postDatas['content'])
                ];

                $this->setTitle($post['title']);

                $commentsDatas = $this->getPostComments($postId);
                $comments = $commentsDatas['comments'];
                $commentNbPage = $commentsDatas['pageCommentNb'];
                $pageTitle     = $this->getTitle();
                $errors        = $this->getInfoMessages();

                if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {
                    $commentFormController = new CommentFormController($post['id_post']);
                    $commentFormComponent  = $commentFormController->commentFormComponent();
                    $this->render(
                        'pages.post', compact('post', 'comments', 'commentNbPage', 'pageTitle', 'errors'),
                        [$commentFormComponent]);
                } else {
                    $this->render(
                        'pages.post', compact('post', 'comments', 'commentNbPage', 'pageTitle', 'errors'));
                }
            } catch (Exception $e) {
                $this->setInfoMessages($e->getMessage());
            }
        } else {
            $errorTitle      = 'Erreur 400';
            $errorMessage    = 'La syntaxe de la requête est erronée.';
            $errorController = new ErrorController($errorTitle, $errorMessage);
            $errorController->error();
        }
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function setPostId(int $postId): PostController
    {
        $this->postId = $postId;
        return $this;
    }

    public function setTitle($title): Controller
    {
        $this->title = parent::getTitle() . ' : ' . $title;
        return $this;
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
        $commentsDatas       = $commentManager->getPostComments($postId, self::COMMENTS_PER_PAGE, $offset);
        $comments  = null;
        foreach ($commentsDatas as $comment) {
            $comments[] = [
                'id'              => $comment['id'],
                'createdDateTime' => 'le ' . htmlspecialchars(
                        $comment['date']) . ' à ' . $comment['time'],
                'author'          => htmlspecialchars($comment['author']),
                'content'         => htmlspecialchars($comment['content'])
            ];
        }
        $comments_nb    = $commentManager->getCommentsNb($postId);
        $pageCommentNb  = ceil($comments_nb / self::COMMENTS_PER_PAGE);

        if (isset($_GET['page']) && $_GET['page'] > $pageCommentNb) {
            $errorTitle      = 'Erreur 404';
            $errorMessage    = 'Cette page n\'existe pas !';
            $errorController = new ErrorController($errorTitle, $errorMessage);
            $errorController->error();
        }
        return compact('comments', 'pageCommentNb');
    }
}