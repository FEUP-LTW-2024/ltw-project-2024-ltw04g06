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
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}


    $userID = $session->getID();
    $userD = User::getUser($db,$userID);

    $userProfileID = $_SESSION['receiverID'];
    $user = User::getUser($db,$userProfileID);

    if ($userID == $userProfileID || $userProfileID == null) {
        header('Location: profile.php');
        exit(); 
    }

    $items = Item::getUserItems($db, $userProfileID);

    topo($db, $userD);
    SeeProfile($db, $user);
    myItemsAnalytics($db, $items);
?>