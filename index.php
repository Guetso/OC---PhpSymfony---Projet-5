<?php
  include './utils/pdo.php';
  $stmt = $bdd->query(
      'SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y\') AS date,
      DATE_FORMAT(date_creation, \'%Hh%imin%ss\') AS time
      FROM billets ORDER BY date_creation DESC LIMIT 0, 10');
  $posts = $stmt ->fetchAll();
  $stmt->closeCursor();
  
  $pageTitle = 'Mon super blog'
?>

<!DOCTYPE html>
<html lang="fr">
<?php include './components/head.php' ?>

<body>
  <section class="news">
    <h1>Mon super blog !</h1>
    <span>Derniers billets de blog:</span>

    <?php
      foreach ($posts as $post) {
          $postTitle = htmlspecialchars($post['titre']) .
              ' le ' . htmlspecialchars($post['date']) .
              ' à ' .  htmlspecialchars($post['time']);
          $postContent = htmlspecialchars($post['contenu']);
          $postLink = './pages/post.php?post=' . htmlspecialchars($post['id']); ?>
          <article>
            <h3><?= $postTitle ?></h3>
            <p><?= $postContent ?>
              <br />
              <a href="<?=$postLink ?>">Commentaires</a>
            </p>
          </article>
     <?php
      }
    ?>
  </section>
</body>
</html>