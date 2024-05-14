<?php 
    require_once(__DIR__ . '/../templates/logs.php');
    require_once(__DIR__ . '/../classes/session.class.php'); 

    $session = new Session(); 
    displayNameLogo();
    signUpBox($session);
?>