<?php
	require_once(__DIR__ . '/../classes/session.class.php');
	require_once(__DIR__ . '/../database/connectdb.php');
	require_once(__DIR__ . '/../classes/user.class.php');

	$session = new Session();
	$db = getDatabaseConnection();

	$username = $_POST['username'];
	$email = $_POST['email'];
    $password = $_POST['password'];

	$addedUserID = User::addUser($db, $username, $email, $password);
	if($addedUserID!=false) {
		$user = User::getUser($db, $addedUserID);
		$session->setId($user->userID);
    $session->setName($user->username);
    $session->addMessage('success', 'Log in successful!');
		header('Location: /../pages/home.php');
  } else {
    $session->addMessage('error', 'An account already exists with that username or email!');
		header('Location: /../pages/signUp.php');
  }

?>