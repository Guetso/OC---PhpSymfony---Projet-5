<?php
  include './utils/pdo.php';

  $stmt = $bdd->query(
      'SELECT id, title, content, DATE_FORMAT(created_at, \'%d/%m/%Y\') AS date,
      DATE_FORMAT(created_at, \'%Hh%imin%ss\') AS time
      FROM posts ORDER BY created_at DESC LIMIT 0, 10');
  $posts = $stmt ->fetchAll();
  $stmt->closeCursor();
  
  $pageTitle = 'Mon super blog';

  require('./templates/index.php');
