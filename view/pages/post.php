<?php
/** @var string $postTitle */
/** @var string $postContent */
ob_start();
?>
<article class="news">
    <h1>Mon super blog !</h1>
    <a href="?action=posts">Retour à la liste des billets</a>

    <h3>
        <?= $postTitle ?>
    </h3>

    <p>
        <?= $postContent ?>
    </p>
</article>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
