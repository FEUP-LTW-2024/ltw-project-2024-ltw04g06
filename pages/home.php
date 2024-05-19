<?php 
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../templates/anuncio.php');
    require_once(__DIR__ . '/../templates/itemDisplay.php');
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    
    $db = getDatabaseConnection();
    $session = new Session();
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}
    
    $userID = $session->getID();
    $user = User::getUser($db, $userID);

    $category = $_GET["category"] ?? null;
    $condition = $_GET["condition"] ?? null;
    $size = $_GET["size"] ?? null;
    $minPrice = $_GET["min"] ?? null;
    $maxPrice = $_GET["max"] ?? null;
  


  topo($db, $user);
  anuncio($db);
  if (isset($_GET["word"])) $items = Item::getItemsByName($db, $_GET["word"]);
  else $items = Item::getFilteredItems($db, $category, $condition, $minPrice, $size, $maxPrice);
  itemDisplay($items, $db, $userID);
?>


