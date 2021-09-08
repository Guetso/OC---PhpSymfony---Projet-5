<?php
/** @var array $comments */
/** @var float $pageCommentNb */
/** @var int $postId */
?>
<aside>
    <h2>Commentaires</h2>

    <?php
    foreach ($comments as $comment) {
        $commentAuthor = htmlspecialchars($comment['author']);
        $commentDate = ' le ' . htmlspecialchars($comment['date']) . ' à ' . htmlspecialchars($comment['time']);
        $commentContent = htmlspecialchars($comment['content']); ?>
        <span>
          <b><?= $commentAuthor ?></b>, <?= $commentDate ?>
        </span>
        <p><?= $commentContent ?></p>
        <?php
    }
    ?>
    <div>Page:</div>
    <ul>
        <?php
        for ($i = 1; $i <= $pageCommentNb; $i++) {
            $link = '?action=post&post=' . htmlspecialchars($postId) . '&page=' . htmlspecialchars($i);
            echo '<li>' . '<a href="' . $link . '">' . $i . '</a>' . '</li>';
        }
        ?>
    </ul>
</aside>