<?php ob_start(); ?>
<h1><?= $pageTitle ?></h1>
<a href="posts.php">Voir les articles</a>
<br/>
<a href="signup.php">S'inscrire</a>
<br/>
<a href="login.php">Se connecter</a>
<?php $content = ob_get_clean(); ?>

<?php require('templates/template.php'); ?>
