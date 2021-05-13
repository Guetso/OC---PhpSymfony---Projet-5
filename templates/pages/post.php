<?php ob_start(); ?>
<article class="news">
    <h1>Mon super blog !</h1>
    <a href="posts.php">Retour à la liste des billets</a>

    <h3>
        <?= $postTitle ?>
    </h3>

    <p>
        <?= $postContent ?>
    </p>
</article>

<?php require './components/comments.php' ?>
<?php $content = ob_get_clean(); ?>

<?php require('templates/template.php'); ?>
