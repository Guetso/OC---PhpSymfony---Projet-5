<?php
/** @var string $errorTitle */
/** @var string $errorMessage */
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= /** @var string $errorTitle */ $errorTitle ?>
    </title>
</head>
<body>
  <h1><?= $errorTitle ?></h1>
  <p><?= $errorMessage ?></p>
</body>
</html>