<?php 

    require_once(__DIR__ . '/../classes/session.class.php');

    $session = new Session();
    $_SESSION['receiverID'] = $_POST['receiverID'];
    $_SESSION['page'] = 'actionProfileToMessage';
    header('Location: /../pages/message.php');
    
?>