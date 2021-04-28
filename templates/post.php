<!DOCTYPE html>
<html lang="fr">
<?php include 'head.php' ?>

<body>
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

<?php include './components/comments.php' ?>

</body>
</html>
