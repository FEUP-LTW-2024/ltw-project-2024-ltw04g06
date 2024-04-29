<?php
	require_once(__DIR__ . '/../classes/session.class.php');
	require_once(__DIR__ . '/../database/connectdb.php');
	require_once(__DIR__ . '/../classes/message.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');


	$db = getDatabaseConnection();
    $session = new Session();

    /*
    // Check if the user is logged in ( para já como nao temos conexao com o sign in e msgs isto vai ficar comentado)
    if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }*/

	$content = $_POST['content'];
	$recipientID = $_POST['recipientID'];
	$senderID = $_POST['senderID'];
    $sender = User::getUser($db, $senderID);

	$messageID = Message::addMessage($db, $senderID, $recipientID, $content);

    if($messageID!= false){
        echo '<div class="fr">
        <img src='.$sender->profilePicture.'>
        <span>'.$sender->username.'</span>
        <div class="time"> Que horas serao </div>
         </div>
        <div class="msg">
        '.$content.'
         </div>';
        exit;
    }
    else{ die(header('Location: /'));}

?>