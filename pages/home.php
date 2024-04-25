<?php 
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../templates/anuncio.php');
    require_once(__DIR__ . '/../templates/itemDisplay.php');
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    
  $session = new Session();
  $db = getDatabaseConnection();
  
  topo();
  anuncio();
  $items = Item::getFilteredItems($db);
  itemDisplay($items);
?>