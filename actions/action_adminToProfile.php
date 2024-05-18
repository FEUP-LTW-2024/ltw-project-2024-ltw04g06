<?php 

    require_once(__DIR__ . '/../classes/session.class.php');

    $session = new Session();
    $_SESSION['receiverID'] = $_POST['userId'];
    header('Location: /../pages/seeProfile.php');
    
?>