<?php
/** @var string $pageTitle */
/** @var array $posts */
?>

<section class="news">
    <h1><?= $pageTitle ?></h1>
    <a href="./">Accueil</a>
    <span>Derniers billets de blog:</span>
    <br/>
    <?php
    if (!$posts) {
        echo '<strong>Pas de billet</strong>';
    }
    ?>

    <?php
    foreach ($posts as $post) {
        ?>
        <article>
            <h3><?= $post->getTitle() ?> - Le <?= $post->getModifiedAt() ?> par <?= $post->getAuthor() ?></h3>
            <p><?= $post->getSubtitle() ?>
                <br/>
                <a href="<?= '?action=post&post=' . $post->getId() ?>">Voir plus...</a>
            </p>
        </article>
        <?php
    }
    ?>
</section>
