<?php
	require_once(__DIR__ . '/../classes/session.class.php');
	require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/user.class.php');


	$db = getDatabaseConnection();
    $session = new Session();

	if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }

    $userID = $session->getID();

    $username = $_POST['username'];
	$email = $_POST['email'];

    $editUsername = User::editUsername($db, $userID, $username);
    $editEmail = User::editemail($db, $userID, $email);

    if($editUsername || $editEmail){
        $session->addMessage('success', 'Edit account successful!');
        header('Location: /../pages/settings.php');
        }
        else{
            $session->addMessage('error', 'Did not edit account settings!');
            header('Location: /../pages/settings.php');
        }


?>