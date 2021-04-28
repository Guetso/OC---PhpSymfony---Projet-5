<?php ob_start(); ?>
    <h1><?= $pageTitle ?></h1>
    <a href="../posts.php">Voir les articles</a>
    <br/>
    <a href="../signup.php">S'inscrire</a>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
