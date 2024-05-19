<?php
	require_once(__DIR__ . '/../classes/session.class.php');
	require_once(__DIR__ . '/../database/connectdb.php');
	require_once(__DIR__ . '/../classes/user.class.php');

	$session = new Session();
	$db = getDatabaseConnection();


    if ($_SESSION['csrf'] !== $_POST['csrf']) { header('Location: /../pages/error.php');exit; }


	$userField = $_POST['userField'];
  	$password = $_POST['password'];

	echo "AAAAAAAAAAAAAAAAAAAAA";


	if((validUsername($userField)||validEmail($userField))&&validPassword($password)){
		$user = User::verifyUserPass($db, $userField, $password);
		if ($user !== false) {
			$session->setId($user->userID);
			$session->setName($user->username);
			$session->addMessage('success', 'Log in successful!');
			header('Location: /../pages/home.php');
		}
		else {
			$session->addMessage('error', 'Wrong username/email or password!');
			header('Location: /../pages/signIn.php');
	    }
  	} else {
		$session->addMessage('error', 'Invalid username/email or password!');
		header('Location: /../pages/signIn.php');
	}

?>