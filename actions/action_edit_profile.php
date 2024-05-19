<?php
	require_once(__DIR__ . '/../classes/session.class.php');
	require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/user.class.php');


	$db = getDatabaseConnection();
    $session = new Session();
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}
    if ($_SESSION['csrf'] !== $_POST['csrf']) { header('Location: /../pages/error.php'); exit; }


    $userID = $session->getID();
    $name = $_POST['name'];
	$aboutMe = $_POST['aboutMe'];

    unlink(__DIR__ . "/../images/profilePictures/$userID.jpg");
    Image::addImage($db, "/../images/profilePictures/$userID.jpg");
    $imageID = $db->lastInsertId();
    $originalFileName =  __DIR__ . "/../images/profilePictures/$userID.jpg";
  
    move_uploaded_file($_FILES['foto']['tmp_name'], $originalFileName);

    if(validName($name) && validAboutMe($aboutMe)){
        $editName = User::editName($db, $userID, $name);
        $editAboutMe = User::editAboutMe($db,$userID,$aboutMe);
        $Image = User::editImage($db, $userID, $imageID);
        if($editName || $editAboutMe){
       $session->addMessage('success', 'Edit profile successful!');
        }
    header('Location: /../pages/settings.php');

    }
    else{
        if(!validName($name)){
        $session->addMessage('error', 'invalid name!');
            header('Location: /../pages/settings.php');}
        if(!validAboutMe($aboutMe)){
            $session->addMessage('error', 'About me as a maximum of 70 characters!');
            header('Location: /../pages/settings.php');}
        }

	?>