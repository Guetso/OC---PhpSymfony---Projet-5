<?php
require('config.php');
require('model.php');

$pageTitle = 'Connexion';
$errorMessages = [
    'generic' => [],
];

if (isset($_POST['controlSubmit'])) {
    echo 'coucou';
}

require('templates/pages/login.php');