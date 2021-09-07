<?php
/** @var string $pageTitle */
/** @var array $postsData */
?>

<section class="news">
    <h1><?= $pageTitle ?></h1>
    <a href="./">Accueil</a>
    <span>Derniers billets de blog:</span>
    <br/>
    <?php
    if (!$postsData) {
        echo '<strong>Pas de billet</strong>';
    }
    ?>

    <?php
    foreach ($postsData as $postData) {
        ?>
        <article>
            <h3><?= $postData['postDetails'] ?> par <?= $postData['postAuthor'] ?></h3>
            <p><?= $postData['postChapo'] ?>
                <br/>
                <a href="<?= $postData['postLink'] ?>">Voir plus...</a>
            </p>
        </article>
        <?php
    }
    ?>
</section>