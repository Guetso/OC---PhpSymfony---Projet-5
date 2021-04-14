<?php
if (isset($_GET['page']) && $_GET['page'] > $pageCommentNb) {
    $errorTitle = 'Erreur';
    $errorMessage = 'Cette page n\'existe pas !';
    include '../pages/error.php';
    die;
}
?>

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
            $link = './post.php?post=' . htmlspecialchars($id_post) . '&page=' . htmlspecialchars($i);
          echo '<li>' . '<a href="'. $link .'">' . $i . '</a>' . '</li>';
        }
      ?>
    </ul>
</aside>
