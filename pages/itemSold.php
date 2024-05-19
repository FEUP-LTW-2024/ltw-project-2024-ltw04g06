<?php 
    require_once(__DIR__ . '/../templates/itemSold.php');
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    require_once(__DIR__ . '/../classes/session.class.php');

    $session = new Session();
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}

    $db = getDatabaseConnection();
    $userID = $session->getID();
    $user = User::getUser($db, $userID);
    topo($db, $user);
    displayItemSold();
    $itemID = $_SESSION['itemID'];
        try {
            $item = Item::getItem($db, $itemID);
            itemSoldForm($item, $db, $userID);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    
?>