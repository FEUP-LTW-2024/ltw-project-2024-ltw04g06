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

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST["category"];
    $condition = $_POST["condition"];
    $minPrice = $_POST["min"];
    $maxPrice = $_POST["max"];
  }else{
    $category = NULL;
    $condition = NULL;
    $minPrice = NULL;
    $maxPrice = NULL;
  }
  
  topo();
  anuncio();
  $items = Item::getFilteredItems($db, $category, $condition, $minPrice, $maxPrice);
  itemDisplay($items, $db);
?>