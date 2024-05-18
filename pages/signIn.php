<?php 
    require_once(__DIR__ . '/../templates/logs.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');

    
    $db = getDatabaseConnection();
    $session = new Session(); 


    displayNameLogo($db);
    signInBox($session);
?>