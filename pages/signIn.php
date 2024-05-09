<?php 
    require_once(__DIR__ . '/../templates/logs.php');
    require_once(__DIR__ . '/../classes/session.class.php'); // Add this line

    $session = new Session(); 
    displayNameLogo();
    signInBox($session);
?>