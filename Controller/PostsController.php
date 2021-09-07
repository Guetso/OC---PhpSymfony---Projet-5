<?php


namespace Blog\Controller;

use Blog\Manager\PostManager;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->setTitle('Mes articles');
    }

    public function posts()
    {
        $postManager = new PostManager();
        $posts = $postManager->getPosts();
        $postsData = [];
        foreach ($posts as $post) {
            $postsData[] = [
                'postDetails' => htmlspecialchars($post['title']) .
                    ' le ' . htmlspecialchars($post['updatedDate']) .
                    ' à ' . htmlspecialchars($post['updatedTime']),
                'postChapo' => htmlspecialchars($post['subtitle']),
                'postAuthor' => $post['author'] ? htmlspecialchars($post['author']) : 'utilisateur inconnu',
                'postLink' => '?action=post&post=' . htmlspecialchars($post['id'])
            ];
        }
        $pageTitle = $this->getTitle();
        $errors = $this->getErrorMessages();
        $this->render('pages.posts', compact('postsData', 'pageTitle', 'errors'));
    }
}