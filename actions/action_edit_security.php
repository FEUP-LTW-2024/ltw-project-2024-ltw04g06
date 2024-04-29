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
    
    $currentPass = $_POST['currentPassword'];
	$newPass = $_POST['newPassword'];
    $confirmNewPass = $_POST['confirmNewPassword'];

    $editPassword = User::editPassword($db, $userID, $currentPass, $newPass, $confirmNewPass);

    if($editPassword){
    $session->addMessage('success', 'Edit security successful!');
    header('Location: /../pages/settings.php');
    }
    else{
        $session->addMessage('error', 'Did not edit security settings!');
		header('Location: /../pages/settings.php');
    }


?>