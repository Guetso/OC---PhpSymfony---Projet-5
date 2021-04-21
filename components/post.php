<?php
  $pageTitle = htmlspecialchars($titre);
  $postTitle= htmlspecialchars($titre) . ' le ' . htmlspecialchars($date) . ' à ' . htmlspecialchars($time);
  $postContent = htmlspecialchars($contenu);

  require('../templates/post.php');