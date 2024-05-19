<?php 

    require_once(__DIR__ . '/../classes/session.class.php');

    $session = new Session();
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}
    if ($_SESSION['csrf'] !== $_POST['csrf']) { header('Location: /../pages/error.php'); exit; }

    $_SESSION['receiverID'] = $_POST['userId'];
    header('Location: /../pages/seeProfile.php');
    
?>