<?php
	require_once(__DIR__ . '/../classes/session.class.php');
	require_once(__DIR__ . '/../database/connectdb.php');
	require_once(__DIR__ . '/../classes/message.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');


	$db = getDatabaseConnection();
    $session = new Session();

	if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }

    $userID = $session->getID();

    $name = $_POST['name'];
	$aboutMe = $_POST['aboutMe'];

    $editName = User::editName($db, $userID, $name);
    $editAboutMe = User::editAboutMe($db,$userID,$aboutMe);

    if($editName || $editAboutMe){
    $session->addMessage('success', 'Edit profile successful!');
    header('Location: /../pages/settings.php');
    }
    else{
        $session->addMessage('error', 'Wrong username/email or password!');
		header('Location: /../pages/signIn.php');
    }

	?>