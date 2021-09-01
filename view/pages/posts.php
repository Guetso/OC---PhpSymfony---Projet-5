<?php
$pageTitle = 'Mes articles !';
/** @var array $posts */
ob_start();
?>

    <section class="news">
        <h1><?= $pageTitle ?></h1>
        <a href="./">Accueil</a>
        <span>Derniers billets de blog:</span>
        <br/>
        <?php
        if(!$posts) {
            echo '<strong>Pas de billet</strong>';
        }
        ?>

        <?php
        foreach ($posts as $post) {
            $postTitle = htmlspecialchars($post['title']) .
                ' le ' . htmlspecialchars($post['date']) .
                ' à ' . htmlspecialchars($post['time']);
            $postChapo = htmlspecialchars($post['subtitle']);
            $postAuthor = $post['author'] ? htmlspecialchars($post['author']) : 'utilisateur inconnu';
            $postLink = '?action=post&post=' . htmlspecialchars($post['id']); ?>
            <article>
                <h3><?= $postTitle ?> par <?= $postAuthor ?></h3>
                <p><?= $postChapo ?>
                    <br/>
                    <a href="<?= $postLink ?>">Voir plus...</a>
                </p>
            </article>
            <?php
        }
        ?>
    </section>
<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>