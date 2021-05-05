<?php ob_start(); ?>
    <section class="news">
        <h1><?= $pageTitle ?></h1>
        <a href="index.php">Accueil</a>
        <span>Derniers billets de blog:</span>

        <?php
        foreach ($posts as $post) {
            $postTitle = htmlspecialchars($post['title']) .
                ' le ' . htmlspecialchars($post['date']) .
                ' à ' . htmlspecialchars($post['time']);
            $postContent = htmlspecialchars($post['content']);
            $postLink = './post.php?post=' . htmlspecialchars($post['id']); ?>
            <article>
                <h3><?= $postTitle ?></h3>
                <p><?= $postContent ?>
                    <br/>
                    <a href="<?= $postLink ?>">Commentaires</a>
                </p>
            </article>
            <?php
        }
        ?>
    </section>
<?php $content = ob_get_clean(); ?>

<?php require('./templates/template.php'); ?>