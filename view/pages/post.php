<?php
/** @var string $postTitle */
/** @var string $postContent */
/** @var string $postChapo */
/** @var string $postAuthor */
/** @var string $updatedDateTime */

$pageTitle = $postTitle;
ob_start();
?>
<article class="news">
    <h1><?= $postTitle ?></h1>
    <span><?= $updatedDateTime ?></span>
    <br/>
    <a href="?action=posts">Retour à la liste des billets</a>

    <h3>
        <?= $postChapo ?>
    </h3>

    <p>
        <?= $postContent ?>
        <br/>
        <strong><?= $postAuthor ?></strong>
    </p>
</article>

<?php $content = ob_get_clean(); ?>

<?php require('view/default.php'); ?>
