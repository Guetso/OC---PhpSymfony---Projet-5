<?php ob_start(); ?>
<h1><?= $pageTitle ?> <?= $_SESSION['pseudo'] ?? '' ?> !</h1>
<a href="posts.php">Voir les articles</a>
<br/>

<?php
if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {
    echo ' <a href="login.php?logout">Se déconnecter</a>';
} else {
    echo ' <a href="login.php">Se connecter</a><br/>';
    echo '<a href="signup.php">S\'inscrire</a>';
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('templates/template.php'); ?>
