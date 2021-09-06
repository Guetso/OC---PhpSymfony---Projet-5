<?php
/** @var array $userName */
/** @var string $pageTitle */
?>

<h1><?= $pageTitle ?> <?= $userName ?> !</h1>
<a href="?action=posts">Voir les articles</a>
<br/>

<?php
if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {
    echo ' <a href="?action=logout">Se déconnecter</a>';
} else {
    echo ' <a href="?action=login">Se connecter</a><br/>';
    echo '<a href="?action=signup">S\'inscrire</a>';
}
?>
