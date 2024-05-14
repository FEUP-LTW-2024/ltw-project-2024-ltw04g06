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
    if(validPassword($currentPass) && validPassword($newPass) && validPassword($confirmNewPass)){
        $editPassword = User::editPassword($db, $userID, $currentPass, $newPass, $confirmNewPass);

        if($editPassword){
        $session->addMessage('success', 'Edit security successful!');
        header('Location: /../pages/settings.php');
        }
        else{
            $session->addMessage('error', 'Did not edit security settings!');
            header('Location: /../pages/settings.php');
        }
    }
    else{
        if($newPass!=$confirmNewPass) $session->addMessage('error', 'Confirm new password must match new password!');
        elseif(!validPassword($newPass)){
            $session->addMessage('passwordError', 'Must be longer than 7 chars and contain at least a letter and a digit.');
            header('Location: /../pages/settings.php');}
        else{
        $session->addMessage('error', 'Invalid  password!');
		header('Location: /../pages/settings.php');
        }
    }


?>