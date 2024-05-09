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

    $userID = $_POST['userId'];
    User::editRole($db, $userID, 'Admin');

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;

?>