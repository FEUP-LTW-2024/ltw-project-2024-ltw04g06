<?php 
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../templates/anuncio.php');
    require_once(__DIR__ . '/../templates/itemDisplay.php');
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    require_once(__DIR__ . '/../classes/session.class.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST["category"];
    $condition = $_POST["condition"];
    $size = $_POST["size"];
    $minPrice = $_POST["min"];
    $maxPrice = $_POST["max"];
  }else if($_SERVER["REQUEST_METHOD"] == "GET"){
    $category = $_GET["category"];
    $condition = NULL;
    $size = NULL;
    $minPrice = NULL;
    $maxPrice = NULL;
  }else{
    $category = NULL;
    $condition = NULL;
    $size = NULL;
    $minPrice = NULL;
    $maxPrice = NULL;
  }
  
  $session = new Session();
  $db = getDatabaseConnection();
  $userID = $session->getID();
  $user = User::getUser($db, $userID);
  topo($user);
  anuncio();
  if (isset($_POST["word"])) $items = Item::getItemsByName($db, $_POST["word"]);
  else $items = Item::getFilteredItems($db, $category, $condition, $minPrice, $size, $maxPrice);
  itemDisplay($items, $db, $userID);
?>

