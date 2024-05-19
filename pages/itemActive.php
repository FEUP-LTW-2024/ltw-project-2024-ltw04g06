<?php 
    require_once(__DIR__ . '/../templates/itemActive.php');
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
    $itemID = $_SESSION['itemID'];
    topo($db, $user);
    displayItemActive();    
        try {
            $item = Item::getItem($db, $itemID);
            itemActiveForm($item, $db);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    
?>