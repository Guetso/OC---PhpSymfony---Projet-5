<!DOCTYPE html>
<html lang="fr">
<?php include './templates/head.php' ?>

<body>
<section class="news">
    <h1><?= $pageTitle ?></h1>
    <span>Derniers billets de blog:</span>

    <?php
    foreach ($posts as $post) {
        $postTitle = htmlspecialchars($post['title']) .
            ' le ' . htmlspecialchars($post['date']) .
            ' à ' .  htmlspecialchars($post['time']);
        $postContent = htmlspecialchars($post['content']);
        $postLink = './pages/post.php?post=' . htmlspecialchars($post['id']); ?>
        <article>
            <h3><?= $postTitle ?></h3>
            <p><?= $postContent ?>
                <br />
                <a href="<?=$postLink ?>">Commentaires</a>
            </p>
        </article>
        <?php
    }
    ?>
</section>
</body>
</html>