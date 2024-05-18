<?php 

    require_once(__DIR__ . '/../classes/session.class.php');

    $session = new Session();
    $_SESSION['itemID'] = $_POST['itemID'];
    header('Location: /../pages/editItem.php');
    
?>