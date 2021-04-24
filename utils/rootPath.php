<?php
function getAddress()
{
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
    return $protocol . '://' . $_SERVER['HTTP_HOST'] . '/';
}