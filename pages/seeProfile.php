<?php
    require_once(__DIR__ . '/../templates/seeProfile.php');
    require_once(__DIR__ . '/../templates/topo.php');
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    require_once(__DIR__ . '/../classes/item.class.php');

    $db = getDatabaseConnection();
    $session = new Session();
    
    if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }

    $userIDD = $session->getID();
    $userD = User::getUser($db,$userIDD);

    $userID = $_POST['userId'];
    $user = User::getUser($db,$userID);

    if ($userIDD == $userID) {
        header('Location: profile.php');
        exit(); 
    }

    $items = Item::getUserItems($db, $userID);

    topo($db, $userD);
    SeeProfile($db, $user);
    myItemsAnalytics($db, $items);
?>