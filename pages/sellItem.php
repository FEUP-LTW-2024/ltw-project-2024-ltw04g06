<?php 
    require_once(__DIR__ . '/../templates/sellItem.php');
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');

    $session = new Session();
    $db = getDatabaseConnection();
    $userID = $session->getID();
    $user = User::getUser($db, $userID);
    displaySellItem();
    sellItemForm();
?>