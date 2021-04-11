<aside>
  <h2>Commentaires</h2>
    <?php
      foreach ($comments as $comment) {
          $commentAuthor = htmlspecialchars($comment['auteur']);
          $commentDate = ' le ' . htmlspecialchars($comment['date']) . ' à ' . htmlspecialchars($comment['time']);
          $commentContent = htmlspecialchars($comment['commentaire']); ?>
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
          echo '<li>' . $i . '</li>';
        }
      ?>
    </ul>
</aside>
