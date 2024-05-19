<?php
	require_once(__DIR__ . '/../classes/session.class.php');
	require_once(__DIR__ . '/../database/connectdb.php');
	require_once(__DIR__ . '/../classes/user.class.php');

	$session = new Session();
	$db = getDatabaseConnection();
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}
    if ($_SESSION['csrf'] !== $_POST['csrf']) { header('Location: /../pages/error.php'); exit; }


    $userID = $session->getID();

	if(User::removeUser($db,$userID)){
		$session->addMessage('success', 'Account deleted!');
	}
	else{
		$session->addMessage('error', 'Failed to remove account.');
	}
	$session->logout();
	header('Location: /../pages/signIn.php');
