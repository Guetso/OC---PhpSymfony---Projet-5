<?php
$pageTitle = 'Bienvenue sur mon blog';
ob_start();
?>

<h1><?= $pageTitle ?> <?= $_SESSION['pseudo'] ?? '' ?> !</h1>
<a href="?action=posts">Voir les articles</a>
<br/>

<?php
if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {
    echo ' <a href="?action=login&logout">Se déconnecter</a>';
} else {
    echo ' <a href="?action=login">Se connecter</a><br/>';
    echo '<a href="?action=signup">S\'inscrire</a>';
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
