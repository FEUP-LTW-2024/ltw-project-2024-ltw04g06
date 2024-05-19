<?php
	require_once(__DIR__ . '/../classes/session.class.php');
	require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/user.class.php');

	$db = getDatabaseConnection();
    $session = new Session();
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}
    if ($_SESSION['csrf'] !== $_POST['csrf']) { header('Location: /../pages/error.php'); exit; }

    $buyerID = $session->getID();
    $address = $_POST['address'];
    $phoneNumber = $_POST['phone'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    if(!validName($name) || !validPhoneNumber($phoneNumber)|| !validEmail($email)) {
        $session->addMessage('error', 'Did not edit shipping Form! Write valid inputs');
        header('Location: /../pages/editShipping.php');
        exit;
    }
    $editAddress = User::editAddress($db, $buyerID, $address);
    $editEmail = User::editEmail($db, $buyerID, $email);
    $editName = User::editName($db, $buyerID, $name);


    if($editAddress || $editPhoneNumber || $editEmail || $editName){
        header('Location: /../pages/creditCard.php');
        }
        else{
            $session->addMessage('error', 'Did not edit shipping Form! Write valid inputs');
            header('Location: /../pages/editShipping.php');
        }

?>