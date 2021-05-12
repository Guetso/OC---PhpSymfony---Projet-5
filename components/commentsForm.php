<?php

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
            createPostComment($id_post, $_SESSION['pseudo'], $_POST['comment']);
        } catch
        (Exception $sqlError) {
            $sqlErrorMessages = $sqlError->getMessage();
            $errorMessages['generic']['sqlError'] = $sqlErrorMessages;

        }
    }
}

require('./templates/components/commentsForm.php');
