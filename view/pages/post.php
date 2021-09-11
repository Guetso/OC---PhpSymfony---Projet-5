<?php
/** @var string $pageTitle */
/** @var array $post */
/** @var array $comments */
/** @var int $commentNbPage */
/** @var array $errors */
/** @var bool $connected */
?>

<article class="news">
    <h1><?= $post['title'] ?></h1>
    <span><?= $post['updatedDateTime'] ?></span>
    <br/>
    <a href="?action=posts">Retour à la liste des billets</a>

    <h3>
        <?= $post['chapo'] ?>
    </h3>

    <p>
        <?= $post['content'] ?>
        <br/>
        <strong><?= $post['author'] ?></strong>
    </p>
</article>
<aside>
    <h2>Commentaires</h2>

    <?php
    foreach ($comments as $comment) {
        ?>
        <span>
          <b><?= $comment['author'] ?></b>, <?= $comment['createdDateTime'] ?>
        </span>
        <p><?= $comment['content'] ?></p>
        <?php
    }
    ?>
    <div>Page:</div>
    <ul>
        <?php
        for ($i = 1; $i <= $commentNbPage; $i++) {
            $link = '?action=post&post=' . htmlspecialchars($post['id']) . '&page=' . htmlspecialchars($i);
            echo '<li>' . '<a href="' . $link . '">' . $i . '</a>' . '</li>';
        }
        ?>
    </ul>
</aside>

<?php
if ($connected) {
    ?>
    <form method="post">
        <input type="hidden" name="controlSubmit">

        <label for="comment">Votre commentaire: </label>
        <br/>
        <textarea id="comment" name="comment" cols="33" rows="5"></textarea>
        <br/>
        <input type="submit" value="Poster">
    </form>
    <br/>
    <span class="error">
        <?php foreach ($errors as $error) {
            echo $error . '<br>';
        } ?>
    </span>
    <br/>
    <?php
}
?>
