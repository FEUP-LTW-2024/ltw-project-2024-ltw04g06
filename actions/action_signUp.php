<?php
	require_once(__DIR__ . '/../classes/session.class.php');
	require_once(__DIR__ . '/../database/connectdb.php');
	require_once(__DIR__ . '/../classes/user.class.php');

	$session = new Session();
	$db = getDatabaseConnection();

	$username = $_POST['username'];
	$email = $_POST['email'];
    $password = $_POST['password'];

  	if(validUsername($username) && validEmail($email) && validPassword($password) && !(User::existingUser($db, $username) || User::existingUser($db, $email))){
	$addedUserID = User::addUser($db, $username, $email, $password);
	if($addedUserID!=false) {
		$user = User::getUser($db, $addedUserID);
		$session->setId($user->userID);
    $session->setName($user->username);
    $session->addMessage('success', 'Log in successful!');
		header('Location: /../pages/signIn.php');
  }
 } else {
	if(!validUsername($username)) {
		$session->addMessage('usernameError', 'Only letters, digits and . - _ are allowed.');
		header('Location: /../pages/signUp.php');
	}
	if(!validEmail($email)) {
		$session->addMessage('emailError', 'invalid email.');
		header('Location: /../pages/signUp.php');
	}
	if(!validPassword($password)) {
		$session->addMessage('passwordError', 'Must be longer than 7 chars and contain at least a letter and a digit.');
		header('Location: /../pages/signUp.php');
	}

	if(User::existingUser($db, $username) || User::existingUser($db, $email)){
		$session->addMessage('usernameError', 'An account already exists with that username or email!');
		header('Location: /../pages/signUp.php');
  	}
  }


?>