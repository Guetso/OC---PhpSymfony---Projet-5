<?php /** @var string $pageTitle */ ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link href="<?= __DIR__.'/public/style.css' ?>" rel="stylesheet"/>
</head>

<body>
<?= $content ?>
</body>
</html>