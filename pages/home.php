<?php 
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');

  $db = getDatabaseConnection();

  topo();
  anuncio();
  itemDisplay();
?>