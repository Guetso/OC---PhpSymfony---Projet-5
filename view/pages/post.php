<?php
/** @var string $postTitle */
/** @var string $postContent */
/** @var string $postChapo */

$pageTitle = $postTitle;
ob_start();
?>
<article class="news">
    <h1><?= $postTitle ?></h1>
    <a href="?action=posts">Retour à la liste des billets</a>

    <h3>
        <?= $postChapo ?>
    </h3>

    <p>
        <?= $postContent ?>
    </p>
</article>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
