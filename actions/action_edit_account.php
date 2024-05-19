<?php
	require_once(__DIR__ . '/../classes/session.class.php');
	require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/user.class.php');


	$db = getDatabaseConnection();
    $session = new Session();
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}
    if ($_SESSION['csrf'] !== $_POST['csrf']) { header('Location: /../pages/error.php'); exit; }


    $userID = $session->getID();

    $username = $_POST['username'];
	$email = $_POST['email'];
    if(validUsername($username) && validEmail($email)){
    $editUsername = User::editUsername($db, $userID, $username);
    $editEmail = User::editemail($db, $userID, $email);

    if($editUsername || $editEmail){
        $session->addMessage('success', 'Edit account successful!');
        header('Location: /../pages/settings.php');
        }
    header('Location: /../pages/settings.php');
    }
    else{
        if(!validUsername($username)){
            $session->addMessage('error','Only letters, digits and . - _ are allowed.');
            header('Location: /../pages/settings.php');
        }
        if(!validEmail($email)){
            $session->addMessage('error','invalid email.');
            header('Location: /../pages/settings.php');
        }
    }

?>