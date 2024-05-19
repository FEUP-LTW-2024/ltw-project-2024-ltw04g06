<?php 

    require_once(__DIR__ . '/../classes/session.class.php');

    $session = new Session();
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}

    $_SESSION['itemID'] = $_POST['itemID'];
    header('Location: /../pages/itemSold.php');
    
?>