<form method="post">
    <input type="hidden" name="controlSubmit">

    <label for="comment">Votre commentaire: </label>
    <br/>
    <textarea id="comment" name="comment" cols="33" rows="5"></textarea>
    <br/>
    <input type="submit" value="Poster">
</form>
<br/>
<span class="error">
        <?php foreach ($errorMessages['generic'] as $errorMessage) {
            echo $errorMessage . '<br>';
        } ?>
    </span>
<br/>