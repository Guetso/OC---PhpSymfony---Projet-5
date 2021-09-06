<?php
/** @var array $errors */
/** @var string $pageTitle */
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
    <?php
    foreach ($errors as $errorMessage) {
        echo $errorMessage . '<br>';
    } ?>
</span>

