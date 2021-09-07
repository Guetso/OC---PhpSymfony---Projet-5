<?php
/** @var string $pageTitle */
/** @var array $postData */
?>

<article class="news">
    <h1><?= $postData['postTitle'] ?></h1>
    <span><?= $postData['updatedDateTime'] ?></span>
    <br/>
    <a href="?action=posts">Retour à la liste des billets</a>

    <h3>
        <?= $postData['postChapo'] ?>
    </h3>

    <p>
        <?= $postData['postContent'] ?>
        <br/>
        <strong><?= $postData['postAuthor'] ?></strong>
    </p>
</article>
