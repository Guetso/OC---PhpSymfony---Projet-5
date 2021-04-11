<?php
  try {
      $bdd = new PDO(
          'mysql:host=localhost;dbname=myblog;charset=utf8',
          'guetso',
          'polo2068',
          array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
      );
  } catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
  }
  