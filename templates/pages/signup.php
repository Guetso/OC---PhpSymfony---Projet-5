<?php ob_start(); ?>
    <h1><?= $pageTitle ?></h1>

    <form method="post">
        <input type="hidden" name="controlSubmit">

        <label for="pseudo">Pseudo: </label>
        <input id="pseudo" type="text" name="pseudo" value="<?= $_POST['pseudo'] ?? '' ?>">
        <br/>
        <label for="email">Email: </label>
        <input id="email" type="email" name="email" value="<?= $_POST['email'] ?? '' ?>">
        <span class="error"><?= $errorMessages['emailError'] ?? '' ?></span>
        <br/>
        <label for="password">Mot de passe: </label>
        <input id="password" type="password" name="password">
        <span class="error"><?= $errorMessages['passError'] ?? '' ?></span>
        <br/>
        <label for="passwordConfirm">Confirmer le mot de passe</label>
        <input id="passwordConfirm" type="password" name="passwordConfirm">
        <span class="error"><?= $errorMessages['confirmError'] ?? '' ?></span>
        <br/>
        <input type="submit" value="S'inscrire">
    </form>
    <br/>
    <span class="error">
        <?php foreach ($errorMessages['generic'] as $errorMessage) {
            echo $errorMessage . '<br>';
        } ?>
    </span>
    <br/>
    <div>
        <span>Un mot de passe valide aura:</span>
        <ul>
            <li>de 8 à 15 caractères</li>
            <li>au moins une lettre minuscule</li>
            <li>au moins une lettre majuscule</li>
            <li>au moins un chiffre</li>
            <li>au moins un de ces caractères spéciaux: $ @ % * + - _ !</li>
            <li>aucun autre caractère spécial</li>
        </ul>
    </div>
<?php $content = ob_get_clean(); ?>

<?php require('templates/template.php'); ?>