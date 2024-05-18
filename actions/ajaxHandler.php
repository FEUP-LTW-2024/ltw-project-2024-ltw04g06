<?php
require_once(__DIR__ . '/../templates/message.php');
require_once(__DIR__ . '/../classes/session.class.php');

    
    $session = new Session();
    $receiverID = $_GET['userID'];
    $userID = $session->getID();
    json_encode(messageBox(getDatabaseConnection(), $userID, $receiverID));
?>
