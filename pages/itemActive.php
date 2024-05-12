<?php 
    require_once(__DIR__ . '/../templates/itemActive.php');
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');
    
    $session = new Session();
    $db = getDatabaseConnection();
    $userID = $session->getID();
    $user = User::getUser($db, $userID);
    topo($user);
    displayItemActive();
    itemActiveForm();
?>