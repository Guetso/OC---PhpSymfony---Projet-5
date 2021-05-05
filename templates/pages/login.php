<?php ob_start(); ?>
<h1><?= $pageTitle ?></h1>

<form method="post">
    <input type="hidden" name="controlSubmit">

    <label for="pseudo">Pseudo: </label>
    <input id="pseudo" type="text" name="pseudo" value="<?= $_POST['pseudo'] ?? '' ?>">
    <br/>
    <label for="password">Mot de passe: </label>
    <input id="password" type="password" name="password">
    <span class="error"><?= $errorMessages['passError'] ?? '' ?></span>
    <br/>
    <input type="submit" value="Se connecter">
</form>
<?php $content = ob_get_clean(); ?>

<?php require('templates/template.php'); ?>
