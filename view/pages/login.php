<?php
$pageTitle = 'Connexion';
ob_start();
?>

<h1><?= $pageTitle ?></h1>

<form method="post">
    <input type="hidden" name="controlSubmit">

    <label for="pseudo">Pseudo: </label>
    <input id="pseudo" type="text" name="pseudo" value="<?= $_POST['pseudo'] ?? '' ?>">
    <br/>
    <label for="password">Mot de passe: </label>
    <input id="password" type="password" name="password">
    <br/>
    <input type="submit" value="Se connecter">
</form>
<br/>
<span class="error">
        <?php foreach ($errorMessages['generic'] as $errorMessage) {
            echo $errorMessage . '<br>';
        } ?>
</span>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
