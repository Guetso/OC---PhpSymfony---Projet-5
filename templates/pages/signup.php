<?php ob_start(); ?>
<h1><?= $pageTitle ?></h1>

<form action="../../signup.php" method="post">
    <label for="pseudo">Pseudo: </label>
    <input id="pseudo" type="text" name="pseudo">
    <br/>
    <label for="email">Email: </label>
    <input id="email" type="email" name="email">
    <br/>
    <label for="password">Mot de passe: </label>
    <input id="password" type="password" name="password">
    <br/>
    <label for="passwordConfirm">Confirmer le mot de passe</label>
    <input id="passwordConfirm" type="password" name="passwordConfirm">
    <br/>
    <input type="submit" value="S'inscrire">
</form>
<br/>
<span><?= $errorMessage ?></span>
<?php $content = ob_get_clean(); ?>

<?php require('templates/template.php'); ?>