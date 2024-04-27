<?php
require_once(__DIR__ . '/../templates/message.php');

    $userID = $_GET['userID'];
    json_encode(messageBox($userID));
?>
