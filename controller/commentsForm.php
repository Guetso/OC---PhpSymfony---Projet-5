<?php

use Hugo\Blog\Model\CommentManager;

require_once('model/CommentManager.php');

/** @var integer $id_post */

$errorMessages = [
    'generic' => [],
];

if (isset($_POST['controlSubmit'])) {
    $validForm = true;
    if (empty($_POST['comment'])) {
        $validForm = false;
        $errorMessages['generic']['empty'] = 'Votre commentaire est vide !';
    }
    if ($validForm === true) {
        $_POST['comment'] = htmlspecialchars($_POST['comment']);
        try {
            $commentManager = new CommentManager();
            $commentManager->createPostComment($id_post, $_SESSION['id'], $_POST['comment']);
            header('Location: ?action=post&post='.$id_post);
        } catch
        (Exception $sqlError) {
            $sqlErrorMessages = $sqlError->getMessage();
            $errorMessages['generic']['sqlError'] = $sqlErrorMessages;
        }
    }
}

require('./view/components/commentsForm.php');
