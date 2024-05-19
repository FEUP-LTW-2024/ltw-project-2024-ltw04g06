<?php 
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../templates/editItem.php');
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');

    $session = new Session();
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}

    $db = getDatabaseConnection();
    $userID = $session->getID();
    $itemID = $_SESSION['itemID'];
    $item = Item::getItem($db, $itemID);
    $user = User::getUser($db, $userID);
    topo($db, $user);
    displayEditItem($item);
    editItemForm($item, $session);
?>